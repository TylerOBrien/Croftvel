<?php

namespace App\Http\Requests\Api\v1\Company;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Company;

class UpdateCompany extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'company';
        $this->model = Company::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
