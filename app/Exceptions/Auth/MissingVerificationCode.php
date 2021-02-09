<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ApiException;

class MissingVerificationCode extends ApiException
{
    /**
     * Instantiate the exception.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct('auth.email-verification.missing', 422);
    }
}
