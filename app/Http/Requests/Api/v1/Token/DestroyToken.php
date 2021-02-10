<?php

namespace App\Http\Requests\Api\v1\Token;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\PersonalAccessToken;

class DestroyToken extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'token';
        $this->model = PersonalAccessToken::class;
    }
}
