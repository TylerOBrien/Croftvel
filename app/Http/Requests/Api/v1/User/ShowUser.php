<?php

namespace App\Http\Requests\Api\v1\User;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\User;

class ShowUser extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'user';
        $this->model = User::class;
    }
}
