<?php

namespace App\Http\Requests\Api\v1\ProfileTextEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileTextEntry;

class IndexProfileTextEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = ProfileTextEntry::class;
    }
}
