<?php

namespace App\Http\Requests\Api\v1\Address;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Address;
use App\Traits\Requests\Api\v1\{ HasAddress, HasOwnership };

class StoreAddress extends ApiRequest
{
    use HasAddress, HasOwnership;

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
        return array_merge($this->addressStoreRules(),
            [
                'name' => 'required|string',
                'owner_id' => 'required|morphable',
                'owner_type' => 'required|morphable',
            ],
        );
    }
}
