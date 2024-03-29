<?php

namespace App\Http\Requests\Api\v1\User;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\User;

class RestoreUser extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'restore';
        $this->binding = 'user';
        $this->model = User::class;
    }
}
