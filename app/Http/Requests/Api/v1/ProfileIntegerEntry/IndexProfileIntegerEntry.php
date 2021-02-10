<?php

namespace App\Http\Requests\Api\v1\ProfileIntegerEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileIntegerEntry;

class IndexProfileIntegerEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = ProfileIntegerEntry::class;
    }
}