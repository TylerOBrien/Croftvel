<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ApiException;

class NotAdmin extends ApiException
{
    /**
     * Instantiate the exception.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct('auth.not-admin', 400);
    }
}