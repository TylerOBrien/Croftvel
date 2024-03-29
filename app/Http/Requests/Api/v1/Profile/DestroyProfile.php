<?php

namespace App\Http\Requests\Api\v1\Profile;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Profile;

class DestroyProfile extends ApiRequest
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
