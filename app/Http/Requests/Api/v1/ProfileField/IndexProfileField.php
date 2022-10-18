<?php

namespace App\Http\Requests\Api\v1\ProfileField;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileField;

class IndexProfileField extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = ProfileField::class;
    }
}
