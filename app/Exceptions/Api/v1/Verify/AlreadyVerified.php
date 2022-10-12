<?php

namespace App\Exceptions\Api\v1\Verify;

use App\Exceptions\Api\ApiException;

class AlreadyVerified extends ApiException
{
    /**
     * Create a new exception.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('verification.already', 422);
    }
}
