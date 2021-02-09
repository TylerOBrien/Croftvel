<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ApiException;

class MissingToken extends ApiException
{
    /**
     * Instantiate the exception.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct('auth.token.missing', 400);
    }
}
