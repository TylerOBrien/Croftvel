<?php

namespace App\Exceptions\Api\v1\Credentials;

use App\Exceptions\Api\ApiException;

class InvalidOptions extends ApiException
{
    /**
     * Create a new exception.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('support.credentials.options.invalid', 500);
    }
}
