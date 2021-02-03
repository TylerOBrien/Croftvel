<?php

namespace App\Http\Requests\Api\v1\Meta;

use App\Models\Meta;
use App\Http\Requests\Api\v1\ApiRequest;

class DestroyMeta extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'meta';
        $this->model = Meta::class;
    }
}
