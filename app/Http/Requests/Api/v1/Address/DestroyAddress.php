<?php

namespace App\Http\Requests\Api\v1\Address;

use App\Models\Address;
use App\Http\Requests\Api\v1\ApiRequest;

class DestroyAddress extends ApiRequest
{
    /**
     * Instantiate the request.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'address';
        $this->model = Address::class;
    }
}
