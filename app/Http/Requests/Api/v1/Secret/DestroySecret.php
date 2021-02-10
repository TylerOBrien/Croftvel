<?php

namespace App\Http\Requests\Api\v1\Secret;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Secret;

class DestroySecret extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'secret';
        $this->model = Secret::class;
    }
}
