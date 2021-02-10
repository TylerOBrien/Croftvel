<?php

namespace App\Exceptions\Auth\Api\v1\Auth;

use App\Exceptions\ApiException;

class InvalidToken extends ApiException
{
    /**
     * Create a new exception.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct('auth.token.invalid', 401);
    }
}
