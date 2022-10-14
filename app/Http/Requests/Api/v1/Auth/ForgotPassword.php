<?php

namespace App\Http\Requests\Api\v1\Auth;

use App\Http\Requests\Api\v1\ApiRequest;

class ForgotPassword extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->has('identity_id')) {
            return [
                'identity_id' => 'required|int|exists:identities,id',
            ];
        }

        return [
            'identity.type' => 'required|string|in:' . join(',', config('enum.identity.type')),
            'identity.value' => 'required|string' . $this->identityRule(),
        ];
    }

    /**
     * Generate the appropriate rule string for the identity based on the given
     * identity type.
     *
     * @return string
     */
    protected function identityRule() : string
    {
        switch (request('identity.type')) {
        case 'email':
            return '|email';
        default:
            return '';
        }
    }
}
