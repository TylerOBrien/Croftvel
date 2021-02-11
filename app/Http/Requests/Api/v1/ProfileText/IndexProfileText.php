<?php

namespace App\Http\Requests\Api\v1\ProfileText;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Profile;

class IndexProfileText extends ApiRequest
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
