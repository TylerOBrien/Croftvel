<?php

namespace App\Http\Requests\Api\v1\OAuth;

use App\Http\Requests\Api\v1\OAuthRequest;

class ShowOAuthUser extends OAuthRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|string',
        ];
    }
}
