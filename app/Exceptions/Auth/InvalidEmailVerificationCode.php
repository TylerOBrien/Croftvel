<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ApiException;

class InvalidEmailVerificationCode extends ApiException
{
    /**
     * Instantiate the exception.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct('auth.email-verification.invalid', 422);
    }
}
