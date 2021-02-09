<?php

namespace App\Http\Requests\Api\v1\Identity;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Identity;

class IndexIdentity extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = Identity::class;
    }
}
