<?php

namespace App\Guards\Api\v1;

use App\Exceptions\Api\v1\Auth\InvalidCredentials;
use App\Models\Identity;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\{ Guard, UserProvider };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiGuard implements Guard
{
    use GuardHelpers;
    
    protected $provider;
    protected $request;
    protected $identity;
    protected $secret;

    /**
     * Create a new API guard.
     *
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return void
     */
    public function __construct(UserProvider $provider, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
    }

    /**
     * Determine if the current user is authenticated.
     * 
     * @return bool
     */
    public function check()
    {
        return (bool) $this->identity;
    }

    /**
     * Determine if the current user is a guest.
     * 
     * @return bool
     */
    public function guest()
    {
        return is_null($this->identity);
    }

    /**
     * Get the currently authenticated user.
     * 
     * @return \App\Models\Identity|null
     */
    public function identity()
    {
        return $this->identity;
    }

    /**
     * Get the currently authenticated user.
     * 
     * @return \App\Models\User|null
     */
    public function user()
    {
        return $this->identity->user ?? null;
    }

    /**
     * Get the id of the currently authenticated user.
     * 
     * @return int|null
     */
    public function id()
    {
        return $this->identity->user->id ?? null;
    }

    /**
     * Validate a user's credentials.
     * 
     * @return bool
     */
    public function attempt(array $credentials = [])
    {
        [ $this->identity, $this->secret ] = $this->parseCredentials($credentials);

        if (is_null($this->secret)) {
            //
        } else {
            call_user_func([ $this, "bySecret{$this->secret->type}" ], $credentials);
        }

        return $this->identity;
    }

    /**
     * Validate a user's credentials.
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
    protected function bySecretPassword(array $credentials)
    {
        if (!Hash::check($credentials['secret']['value'], $this->secret->value)) {
            throw new InvalidCredentials;
        }
    }

    /**
     * @return void
     */
    protected function bySecretTotp(array $credentials)
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
}
