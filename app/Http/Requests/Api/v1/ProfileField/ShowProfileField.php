<?php

namespace App\Http\Requests\Api\v1\ProfileField;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileField;

class ShowProfileField extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'profile_field';
        $this->model = ProfileField::class;
    }
}
