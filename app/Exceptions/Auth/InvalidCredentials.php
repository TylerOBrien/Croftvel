<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ApiException;

class InvalidCredentials extends ApiException
{
    /**
     * Instantiate the exception.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct('auth.failed', 401);
    }
}
