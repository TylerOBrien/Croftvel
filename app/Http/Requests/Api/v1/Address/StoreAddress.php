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
            'owner_id' => 'required|int',
            'owner_type' => 'required|string',
            'line1' => 'nullable|string',
            'line2' => 'nullable|string',
            'city' => 'nullable|string',
            'province' => 'required|province:' . request('country'),
            'country' => 'required|country',
            'postal_code' => 'nullable|string'
        ];
    }
}
