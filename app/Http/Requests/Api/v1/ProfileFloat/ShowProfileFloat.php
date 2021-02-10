<?php

namespace App\Http\Requests\Api\v1\ProfileFloat;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileFloat;

class ShowProfileFloat extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'profile_float';
        $this->model = ProfileFloat::class;
    }
}
