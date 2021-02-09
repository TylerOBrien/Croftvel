<?php

namespace App\Http\Requests\Api\v1\Address;

use App\Models\Address;
use App\Http\Requests\Api\v1\ApiRequest;

class UpdateAddress extends ApiRequest
{
    /**
     * Instantiate the request.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'address';
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
            'line1' => 'string',
            'line2' => 'string',
            'city' => 'string',
            'province' => 'province',
            'country' => 'country',
            'postal_code' => 'string',
            'owner_id' => 'int',
            'owner_type' => 'string'
        ];
    }
}
