<?php

namespace App\Http\Requests\Api\v1\Identity;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Identity;

class DestroyIdentity extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'identity';
        $this->model = Identity::class;
    }
}
