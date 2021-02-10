<?php

namespace App\Http\Requests\Api\v1\Token;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\PersonalAccessToken;

class StoreToken extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = PersonalAccessToken::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identity.type' => 'required|in:email,mobile,oauth',
            'identity.value' => 'required|string',
            'secret.type' => 'required_with:secret.value|in:password,totp',
            'secret.value' => 'required_with:secret.type|string'
        ];
    }
}
