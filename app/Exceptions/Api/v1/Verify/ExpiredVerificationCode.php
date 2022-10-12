<?php

namespace App\Exceptions\Api\v1\Verify;

use App\Exceptions\Api\ApiException;

class ExpiredVerificationCode extends ApiException
{
    /**
     * Instantiate the exception.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('verification.expired', 422);
    }
}
