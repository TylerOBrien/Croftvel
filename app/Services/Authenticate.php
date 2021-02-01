<?php

namespace App\Services;

use App\Exceptions\Auth\InvalidCredentials;
use App\Helpers\TokenHelper;

use Illuminate\Support\Facades\Auth;

class Authenticate
{
    protected $auth;

    /**
     * 
     */
    public function __construct($guard=null)
    {
        $this->auth = Auth::guard($guard ?? config('auth.defaults.guard'));
    }

    /**
     * 
     */
    public function getToken(array $credentials)
    {
        $token = $this->auth->attempt($credentials);

        if (!$token) {
            throw new InvalidCredentials;
        }

        return TokenHelper::makeResponse($token);
    }

    /**
     * 
     */
    public function refreshToken()
    {
        $token = $this->auth->refresh();

        return TokenHelper::makeResponse($token);
    }
}