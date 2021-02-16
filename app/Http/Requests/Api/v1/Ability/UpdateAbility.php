<?php

namespace App\Http\Requests\Api\v1\Ability;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Ability;

class UpdateAbility extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'ability';
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
            'privilege_id' => 'sometimes|int|exists:privileges,id',
            'name' => 'string',
            'model_id' => 'sometimes|morphable',
            'model_type' => 'sometimes|morphable'
        ];
    }
}
