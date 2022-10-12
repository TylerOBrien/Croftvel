<?php

namespace App\Exceptions\Api\v1\Verify;

use App\Exceptions\Api\ApiException;

class InvalidVerificationAbility extends ApiException
{
    /**
     * Create a new exception.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('verification.invalid-ability', 422);
    }
}
