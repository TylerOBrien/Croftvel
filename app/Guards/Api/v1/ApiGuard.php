<?php

namespace App\Guards\Api\v1;

use App\Exceptions\Api\v1\Auth\InvalidCredentials;
use App\Models\{ Identity, Secret };

use Laravel\Sanctum\Sanctum;

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
     * The number of minutes tokens should be allowed to remain valid.
     *
     * @var int
     */
    protected $expiration;

    /**
     * Create a new API guard.
     *
     * @param  int  $expiration
     * 
     * @return void
     */
    public function __construct(int $expiration)
    {
        $this->expiration = $expiration;
    }

    /**
     * Retrieve the authenticated user for the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \App\Models\User
     */
    public function parseToken(Request $request = null)
    {
        if ($this->check()) {
            return $this->user();
        }

        $request = $request ?? request();
        $bearer_token = $request->bearerToken();

        if (is_null($bearer_token)) {
            return null;
        }

        $now = now();
        $expires_at = $now->subMinutes($this->expiration);
        $pat = Sanctum::$personalAccessTokenModel::findToken($bearer_token);

        if (is_null($pat)) {
            return null;
        } else if ($this->expiration && $pat->created_at->lte($expires_at)) {
            return null;
        }

        $this->user = $pat->tokenable->withAccessToken(
            tap( $pat->forceFill(['last_used_at' => $now]) )->save()
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
     * Attempt to authenticate the user.
     * 
     * @param  array  $credentials
     * 
     * @return \App\Models\User
     */
    public function attempt(array $credentials = [])
    {
        if ($this->check()) {
            die('uhoh');
        }

        [ $identity, $secret ] = $this->parseCredentials($credentials);

        if (is_null($secret)) {
            //
        } else {
            call_user_func([ $this, "bySecret{$secret->type}" ], $credentials, $secret);
        }

        return $this->user = $identity->user;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * 
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        return (bool) $this->attempt($credentials);
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
        $identity = Identity::where($credentials['identity'])->first();

        if (is_null($identity)) {
            throw new InvalidCredentials;
        }

        $provider = $identity->user->secrets();
        $secret = $provider->where('type', $credentials['secret']['type'])->first();

        return [ $identity, $secret ];
    }

    /**
     * Set the currently authenticated user.
     *
     * @param  \App\Models\User  $user
     * 
     * @return void
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Retrieve an instance of this ApiGuard. Intended to help avoid false-positive
     * errors with linters.
     * 
     * @return ApiGuard
     */
    static public function getInstance() : ApiGuard
    {
        return auth('croft');
    }
}
