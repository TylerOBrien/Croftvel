<?php

namespace App\Guards\Api\v1;

use App\Exceptions\Api\v1\Auth\InvalidCredentials;
use App\Models\{ Identity, Secret };

use Laravel\Sanctum\{ HasApiTokens, Sanctum };

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiGuard
{
    /**
     * The authentication factory implementation.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * The currently authenticated user.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The secret used to authenticate
     *
     * @var \App\Models\Secret|null
     */
    protected $secret;

    /**
     * The number of minutes tokens should be allowed to remain valid.
     *
     * @var int
     */
    protected $expiration;

    /**
     * Create a new API guard.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @param  int  $expiration
     * 
     * @return void
     */
    public function __construct($auth, int $expiration, string $provider)
    {
        $this->auth = $auth;
        $this->expiration = $expiration;
    }

    /**
     * Retrieve the authenticated user for the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $bearer_token = $request->bearerToken();

        if (is_null($bearer_token)) {
            return null;
        }

        $pat = Sanctum::$personalAccessTokenModel::findToken($bearer_token);

        if (is_null($pat)) {
            return null;
        } else if ($this->expiration && $pat->created_at->lte(now()->subMinutes($this->expiration))) {
            return null;
        } else if (!$this->supportsTokens($pat->tokenable)) {
            return null;
        }

        $this->user = $pat->tokenable->withAccessToken(
            tap($pat->forceFill(['last_used_at' => now()]))->save()
        );

        return $this->user;
    }

    /**
     * Determine if the current user is authenticated.
     * 
     * @return bool
     */
    public function check()
    {
        return (bool) $this->user;
    }

    /**
     * Determine if the current user is a guest.
     * 
     * @return bool
     */
    public function guest()
    {
        return is_null($this->user);
    }

    /**
     * Get the currently authenticated user.
     * 
     * @return \App\Models\User|null
     */
    public function user()
    {
        return $this->user ?? null;
    }

    /**
     * Get the id of the currently authenticated user.
     * 
     * @return mixed
     */
    public function id()
    {
        return $this->user ? $this->user->getAuthIdentifier() : null;
    }

    /**
     * Validate a user's credentials.
     * 
     * @return bool
     */
    public function attempt(array $credentials = [])
    {
        [ $identity, $secret ] = $this->parseCredentials($credentials);

        if (is_null($secret)) {
            //
        } else {
            call_user_func([ $this, "bySecret{$secret->type}" ], $credentials, $secret);
        }

        return $this->user = $identity->user;
    }

    /**
     * @return void
     */
    protected function bySecretPassword(array $credentials, Secret $secret)
    {
        if (!Hash::check($credentials['secret']['value'], $secret->value)) {
            throw new InvalidCredentials;
        }
    }

    /**
     * @return void
     */
    protected function bySecretTotp(array $credentials, Secret $secret)
    {
        //
    }

    /**
     * @return array
     */
    protected function parseCredentials(array $credentials)
    {
        $identity = Identity::where($credentials['identity'])->limit(1)->first();

        if (is_null($identity)) {
            throw new InvalidCredentials;
        }

        $provider = $identity->user->secrets();
        $secret = $provider->where('type', $credentials['secret']['type'])->limit(1)->first();

        return [ $identity, $secret ];
    }

    /**
     * Determine if the tokenable model supports API tokens.
     *
     * @param  mixed  $tokenable
     * 
     * @return bool
     */
    protected function supportsTokens($tokenable)
    {
        if (!$tokenable) {
            return false;
        }

        return (bool) in_array(HasApiTokens::class, class_uses_recursive( get_class($tokenable) ));
    }
}
