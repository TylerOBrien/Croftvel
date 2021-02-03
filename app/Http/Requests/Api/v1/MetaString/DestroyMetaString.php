<?php

namespace App\Http\Requests\Api\v1\MetaString;

use App\Models\MetaString;
use App\Http\Requests\Api\v1\ApiRequest;

class DestroyMetaString extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'string';
        $this->model = MetaString::class;
    }
}
