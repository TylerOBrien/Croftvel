<?php

namespace App\Http\Requests\Api\v1\ProfileFloatEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileFloatEntry;

class IndexProfileFloatEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = ProfileFloatEntry::class;
    }
}
