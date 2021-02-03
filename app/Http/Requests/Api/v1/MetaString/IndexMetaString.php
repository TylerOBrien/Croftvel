<?php

namespace App\Http\Requests\Api\v1\MetaString;

use App\Models\MetaString;
use App\Http\Requests\Api\v1\ApiRequest;

class IndexMetaString extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = MetaString::class;
    }
}
