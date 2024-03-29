<?php

namespace App\Http\Requests\Api\v1\Company;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Company;

class IndexCompany extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = Company::class;
    }
}
