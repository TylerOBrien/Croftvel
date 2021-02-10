<?php

namespace App\Http\Requests\Api\v1\ProfileString;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileString;

class DestroyProfileString extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'profile_string';
        $this->model = ProfileString::class;
    }
}
