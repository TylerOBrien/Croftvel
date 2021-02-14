<?php

namespace App\Http\Requests\Api\v1\Identity;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Identity;

class StoreIdentity extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Identity::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(
            request()->route('user')
                ? []
                : [ 'user_id' => 'sometimes|int|exists:users,id' ],
            [
                'name' => 'required|string',
                'type' => 'required|in:email,mobile,oauth',
                'value' => 'required|unique:identities,value|string'
            ]
        );
    }
}
