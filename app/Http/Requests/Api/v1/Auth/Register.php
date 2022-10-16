<?php

namespace App\Http\Requests\Api\v1\Auth;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Traits\Requests\Api\v1\HasIdentity;

class Register extends ApiRequest
{
    use HasIdentity;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if ($this->input('identity.type') === 'oauth') {
            $oauth_rules = [ 'identity.provider' => $this->identityProviderRule() ];
        } else {
            $oauth_rules = [];
        }

        return array_merge($oauth_rules, [
            'identity.type' => $this->identityTypeRule(),
            'identity.value' => $this->identityValueRule(),
            'secret.type' => 'required|string|in:' . join(',', config('enum.secret.type')),
            'secret.value' => 'required|string',
        ]);
    }
}
