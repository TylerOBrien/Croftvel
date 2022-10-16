<?php

namespace App\Exceptions\Api\v1\Auth;

use App\Exceptions\Api\ApiException;

class MalformedCredentialsFields extends ApiException
{
    /**
     * Create a new exception.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('auth.credentials.malformed-fields', 401);
    }
}
