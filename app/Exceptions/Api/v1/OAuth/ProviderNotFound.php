<?php

namespace App\Exceptions\Api\v1\OAuth;

use App\Exceptions\Api\ApiException;

class ProviderNotFound extends ApiException
{
    /**
     * Create a new exception.
     *
     * @param  int  $http_code  The HTTP status code that will be used in the response.
     *
     * @return void
     */
    public function __construct(int $http_code = 404)
    {
        parent::__construct('oauth.provider.not-found', $http_code);
    }
}
