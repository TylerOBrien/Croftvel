<?php

namespace App\Http\Requests\Api\v1\User;

use App\Models\User;
use App\Http\Requests\Api\v1\ApiRequest;

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
