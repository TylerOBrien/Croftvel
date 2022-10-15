<?php

namespace App\Exceptions\Api\v1\Account;

use App\Exceptions\Api\ApiException;

class AccountSuspended extends ApiException
{
    /**
     * Create a new exception.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('account.suspended', 403);
    }
}
