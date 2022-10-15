<?php

namespace App\Guards\Api\v1;

use App\Events\Api\v1\Auth\AuthAttempted;
use App\Exceptions\Api\v1\Auth\{ ExpiredToken, InvalidCredentials, InvalidToken, MissingToken };
use App\Helpers\Auth\Credentials;
use App\Models\{ Identity, PersonalAccessToken, User };

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiGuard implements Guard
{
    /**
     * The currently authenticated user.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The identity the user used to authenticate.
     *
     * @var \App\Models\Identity
     */
    protected $identity;

    /**
     * The number of minutes tokens should be allowed to remain valid.
     *
     * @var int
     */
    protected $ttl;

    /**
     * Create a new API guard.
     *
     * @param  int|null  $ttl  The number of minutes an auth token will be valid for.
     *
     * @return void
     */
    public function __construct(int|null $ttl = null)
    {
        $this->ttl = $ttl ?: config('security.token.ttl');
    }

    /**
     * Determines if the request contains a bearer token in the headers.
     *
     * @param  \Illuminate\Http\Request|null  $request
     *
     * @return bool
     */
    public function hasToken(Request|null $request = null): bool
    {
        return (bool) ($request ?? request())->bearerToken();
    }

    /**
     * Retrieve the authenticated user for the incoming request.
     *
     * @param  \Illuminate\Http\Request|null  $request
     *
     * @return \App\Models\User
     */
    public function parseToken(Request|null $request = null): User|null
    {
        if ($this->check()) {
            return $this->user();
        }

        $request = $request ?? request();
        $bearer_token = $request->bearerToken();

        if (is_null($bearer_token)) {
            throw new MissingToken;
        }

        $now = now();
        $expires_at = $now->subMinutes($this->ttl);
        $pat = PersonalAccessToken::findFromBearerToken($bearer_token);

        if (is_null($pat)) {
            throw new InvalidToken;
        } else if ($this->ttl && $pat->created_at->lte($expires_at)) {
            throw new ExpiredToken;
        }

        $pat->forceFill([ 'last_used_at' => $now ])->save();
        $pat->tokenable->forceFill([ 'last_active_at' => $now ])->save();

        return $this->user = $pat->tokenable->fresh();
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check(): bool
    {
        return (bool) $this->user;
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest(): bool
    {
        return is_null($this->user);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \App\Models\User|null
     */
    public function user(): User|null
    {
        return $this->user ?? null;
    }

    /**
     * Get the identity used by the currently authenticated user.
     *
     * @return \App\Models\Identity|null
     */
    public function identity(): Identity|null
    {
        return $this->identity ?? null;
    }

    /**
     * Determine if the guard has a user instance.
     *
     * @return bool
     */
    public function hasUser(): bool
    {
        return (bool) $this->user;
    }

    /**
     * Get the id of the currently authenticated user.
     *
     * @return int|null
     */
    public function id(): int|null
    {
        return $this->user ? $this->user->getAuthIdentifier() : null;
    }

    /**
     * Attempt to authenticate the user.
     *
     * @param  array  $fields  The fields containing the raw credentials data, typically from a request.
     *
     * @return \App\Models\User
     */
    public function attempt(array $fields = []): User
    {
       $credentials = Credentials::fromFields($fields);

        if (is_null($credentials->secret)) {
            //
        } else {
            call_user_func([ $this, "bySecret{$credentials->secret->type}" ], $fields, $credentials);
        }

        AuthAttempted::dispatch($credentials->identity, true);

        $this->identity = $credentials->identity;
        $this->user = $credentials->identity->user;

        return $this->user;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $fields  The fields containing the raw credentials data, typically from a request.
     *
     * @return bool
     */
    public function validate(array $fields = []): bool
    {
        return (bool) $this->attempt($fields);
    }

    /**
     * Attempts to validate the fields data against the known password.
     *
     * @param  array  $fields  The fields containing the raw credentials data, typically from a request.
     * @param  Credentials  $credentials  Instances of the models referred to by the raw credentials data.
     *
     * @return void
     */
    protected function bySecretPassword(array $fields, Credentials $credentials): void
    {
        if (!Hash::check($fields['secret']['value'], $credentials->secret->value)) {
            AuthAttempted::dispatch($credentials->identity, false);
            throw new InvalidCredentials;
        }
    }

    /**
     * Attempts to validate the fields data against the TOTP.
     *
     * @param  array  $fields  The fields containing the raw credentials data, typically from a request.
     * @param  Credentials  $credentials  Instances of the models referred to by the raw credentials data.
     *
     * @return void
     */
    protected function bySecretTotp(array $fields, Credentials $credentials): void
    {
        //
    }

    /**
     * Set the currently authenticated user.
     *
     * @param  \App\Models\User  $user
     *
     * @return void
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * Retrieve an instance of this ApiGuard. Intended to help avoid false
     * positive errors with linters.
     *
     * This is an alias of the ApiGuard::getInstance() function.
     *
     * @return \App\Guards\Api\v1\ApiGuard
     */
    static public function get(): ApiGuard
    {
        return self::getInstance();
    }

    /**
     * Retrieve an instance of this ApiGuard. Intended to help avoid false
     * positive errors with linters.
     *
     * @return \App\Guards\Api\v1\ApiGuard
     */
    static public function getInstance(): ApiGuard
    {
        return auth(config('security.guard.name'));
    }
}
