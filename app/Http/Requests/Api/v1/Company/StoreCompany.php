<?php

namespace App\Http\Requests\Api\v1\Company;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Company;
use App\Traits\Requests\Api\v1\HasAddress;

class StoreCompany extends ApiRequest
{
    use HasAddress;

    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Company::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return array_merge(
            $this->addressStoreRules('address.'),
            [
                'name' => 'required|string|unique:companies,name',
            ],
        );
    }
}
