<?php

namespace App\Exceptions\Api\v1\Verify;

use App\Exceptions\Api\ApiException;

class MissingVerificationCode extends ApiException
{
    /**
     * Instantiate the exception.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('verification.missing-code', 422);
    }
}
