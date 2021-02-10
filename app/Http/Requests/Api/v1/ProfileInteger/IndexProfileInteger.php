<?php

namespace App\Http\Requests\Api\v1\ProfileInteger;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileInteger;

class IndexProfileInteger extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = ProfileInteger::class;
    }
}
