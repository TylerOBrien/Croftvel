<?php

namespace App\Http\Requests\Api\v1\Auth;

use App\Http\Requests\Api\v1\OAuthRequest;
use App\Traits\Requests\Api\v1\HasIdentity;

class Register extends OAuthRequest
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
            $rules = [ 'identity.provider' => $this->identityProviderRule() ];
        } else {
            $rules = [ 'identity.value' => $this->identityValueRule() ];
        }

        return array_merge($rules, [
            'identity.type' => $this->identityTypeRule(),
            'secret.type' => 'required|string|in:' . join(',', config('enum.secret.type')),
            'secret.value' => 'required|string',
        ]);
    }
}
