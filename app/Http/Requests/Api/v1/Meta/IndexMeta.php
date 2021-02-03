<?php

namespace App\Http\Requests\Api\v1\Meta;

use App\Models\Meta;
use App\Http\Requests\Api\v1\ApiRequest;

class IndexMeta extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = Meta::class;
    }
}
