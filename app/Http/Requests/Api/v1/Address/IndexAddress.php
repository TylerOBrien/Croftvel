<?php

namespace App\Http\Requests\Api\v1\Address;

use App\Models\Address;
use App\Http\Requests\Api\v1\ApiRequest;
use App\Traits\Requests\Api\v1\HasQueryFilter;

class IndexAddress extends ApiRequest
{
    use HasQueryFilter;

    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = Address::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->indexRules();
    }
}
