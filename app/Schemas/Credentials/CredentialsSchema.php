<?php

namespace App\Schemas\Credentials;

use App\Enums\Identity\IdentityType;
use App\Enums\Secret\SecretType;
use App\Schemas\Schema;

class CredentialsSchema extends Schema
{
    const IDENTITY_AND_SECRET = 0x00;
    const IDENTITY_ONLY       = 0x01;
    const SECRET_ONLY         = 0x10;

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'identity' => 'required|array',
            'identity.type' => 'required|string|in:' . join(',', config('enum.identity.type')),
            'identity.value' => $this->identityValueRule(),
            'identity.provider' => 'required_if:identity.type,' . IdentityType::OAuth->value . '|string|in:' . join(',', config('enum.oauth.provider')),
            'secret' => 'required|array',
            'secret.type' => $this->secretTypeRule(),
            'secret.value' => 'required|string',
        ];
    }

    /**
     * Generate the rule string for the identity.value field.
     *
     * @return string
     */
    protected function identityValueRule(): string
    {
        $rule = 'required_unless:identity.type,' . IdentityType::OAuth->value . '|string';

        switch ($this->attributes['identity']['type'] ?? null) {
        case IdentityType::Email->value:
            $rule .= '|email';
            break;
        case IdentityType::Mobile->value:
            $rule .= '|phone_number';
            break;
        }

        return $rule;
    }

    /**
     * Generate the rule string for the secret.type field.
     *
     * @return string
     */
    protected function secretTypeRule(): string
    {
        $rule = 'required|string';

        switch ($this->attributes['identity']['type'] ?? null) {
        case IdentityType::Email->value:
        case IdentityType::Mobile->value:
            $rule .= '|in:' . SecretType::Password->value . ',' . SecretType::TOTP->value;
            break;
        case IdentityType::OAuth->value:
            $rule .= '|in:' . SecretType::OAuth->value;
            break;
        }

        return $rule;
    }
}
