<?php

namespace App\Http\Requests\Api\v1\Company;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Company;

class DestroyCompany extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'company';
        $this->model = Company::class;
    }
}
