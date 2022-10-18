<?php

namespace App\Http\Requests\Api\v1\ProfileField;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileField;

class DestroyProfileField extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'profile_field';
        $this->model = ProfileField::class;
    }
}
