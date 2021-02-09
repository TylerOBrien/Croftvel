<?php

namespace App\Http\Requests\Api\v1\Address;

use App\Models\Address;
use App\Http\Requests\Api\v1\ApiRequest;

class ShowAddress extends ApiRequest
{
    /**
     * Instantiate the request.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'address';
        $this->model = Address::class;
    }
}
