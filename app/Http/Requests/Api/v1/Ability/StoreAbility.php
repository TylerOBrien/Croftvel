<?php

namespace App\Http\Requests\Api\v1\Ability;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Ability;

class StoreAbility extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Ability::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'privilege_id' => 'required|int|exists:privileges,id',
            'name' => 'required|string',
            'model_id' => 'sometimes|required|morphable',
            'model_type' => 'required|morphable'
        ];
    }
}
