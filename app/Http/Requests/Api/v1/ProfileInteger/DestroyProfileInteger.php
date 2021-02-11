<?php

namespace App\Http\Requests\Api\v1\ProfileInteger;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Profile;

class DestroyProfileInteger extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'profile';
        $this->model = Profile::class;
    }
}
