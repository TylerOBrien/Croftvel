<?php

namespace App\Http\Requests\Api\v1\File;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\File;

class IndexFile extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = File::class;
    }
}