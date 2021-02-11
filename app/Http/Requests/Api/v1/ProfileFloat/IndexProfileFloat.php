<?php

namespace App\Http\Requests\Api\v1\ProfileFloat;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Profile;

class IndexProfileFloat extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = Profile::class;
    }
}
