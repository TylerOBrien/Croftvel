<?php

namespace App\Http\Requests\Api\v1\MetaInteger;

use App\Models\MetaInteger;
use App\Http\Requests\Api\v1\ApiRequest;

class DestroyMetaInteger extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'integer';
        $this->model = MetaInteger::class;
    }
}
