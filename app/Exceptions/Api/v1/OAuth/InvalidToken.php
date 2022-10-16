<?php

namespace App\Exceptions\Api\v1\OAuth;

use App\Exceptions\Api\ApiException;

class InvalidToken extends ApiException
{
    /**
     * Create a new exception.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('oauth.token.invalid', 422);
    }
}
