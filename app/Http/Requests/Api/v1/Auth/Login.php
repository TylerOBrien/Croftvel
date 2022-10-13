<?php

namespace App\Http\Requests\Api\v1\Auth;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Traits\Requests\Api\v1\HasIdentity;

class Login extends ApiRequest
{
    use HasIdentity;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identity.type' => $this->identityTypeRule(),
            'identity.value' => $this->identityValueRule(),
            'secret.type' => 'required|string|in:' . join(',', config('croft.enum.secret.type')),
            'secret.value' => 'required|string',
        ];
    }
}