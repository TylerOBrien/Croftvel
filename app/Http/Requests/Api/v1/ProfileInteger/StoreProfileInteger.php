<?php

namespace App\Http\Requests\Api\v1\ProfileInteger;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileInteger;

class StoreProfileInteger extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = ProfileInteger::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'profile_id' => 'required|int|exists:profiles,id',
            'name' => 'required|string',
            'value' => 'required|int'
        ];
    }
}
