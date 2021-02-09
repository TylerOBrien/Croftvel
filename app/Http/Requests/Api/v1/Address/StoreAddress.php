<?php

namespace App\Http\Requests\Api\v1\Address;

use App\Models\Address;
use App\Http\Requests\Api\v1\ApiRequest;

class StoreAddress extends ApiRequest
{
    /**
     * Instantiate the request.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Address::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'line1' => 'required|string',
            'line2' => 'nullable|string',
            'city' => 'required|string',
            'province' => 'required|province',
            'country' => 'required|country',
            'postal_code' => 'required|string',
            'owner_id' => 'required|int',
            'owner_type' => 'required|string'
        ];
    }
}
