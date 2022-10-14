<?php

namespace App\Http\Requests\Api\v1\Address;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Address;
use App\Traits\Requests\Api\v1\{ HasAddress, HasOwnership };

class UpdateAddress extends ApiRequest
{
    use HasAddress, HasOwnership;

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
        return array_merge($this->addressUpdateRules(),
            [
                'name' => 'required|string',
                'owner_id' => 'required_with:owner_type|morphable',
                'owner_type' => 'required_with:owner_id|morphable',
            ],
        );
    }
}
