<?php

namespace App\Traits\Requests\Api\v1;

use App\Enums\Identity\IdentityType;
use App\Enums\OAuth\OAuthProvider;

trait HasIdentity
{
    /**
     * @return void
     */
    protected function prepareOAuthIfGiven(): void
    {
        $request = request();

        if ($request->input('identity.type') === IdentityType::OAuth->value) {
            if ($request->input('identity.provider') === OAuthProvider::Twitter->value) {
                session()->put('code_verifier', $request->input('code_verifier'));
            }

            $request->merge([
                'code' => $request->input('secret.value'),
            ]);
        }
    }

    /**
     * Generate the rule for the identity_id field.
     *
     * @return string
     */
    protected function identityIdRule(): string
    {
        return 'required|int|exists:identities,id';
    }

    /**
     * Generate the rule for the identity.type field.
     *
     * @return string
     */
    protected function identityTypeRule(): string
    {
        return 'required|string|in:' . join(',', config('enum.identity.type'));
    }

    /**
     * Generate the rule for the identity.provider field.
     *
     * @return string
     */
    protected function identityProviderRule(): string
    {
        return 'required|string|in:' . join(',', config('enum.oauth.provider'));
    }

    /**
     * Generate the appropriate rule string for the identity.value based on the
     * given identity type.
     *
     * @return string
     */
    protected function identityValueRule(): string
    {
        switch ($this->get('identity.type')) {
        case 'email':
            return '|email';
        default:
            return '';
        }
    }
}
