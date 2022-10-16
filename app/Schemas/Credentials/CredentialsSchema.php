<?php

namespace App\Schemas\Credentials;

use App\Enums\Identity\IdentityType;
use App\Schemas\Schema;

class CredentialsSchema extends Schema
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'identity' => 'required|array',
            'identity.type' => 'required|string|in:' . join(',', config('enum.identity.type')),
            'identity.value' => $this->identityValueRule(),
            'identity.provider' => 'required_if:identity.type,' . IdentityType::OAuth->value . '|string|in:' . join(',', config('enum.oauth.provider')),
            'secret' => 'required|array',
            'secret.type' => 'required|string|in:' . join(',', config('enum.secret.type')),
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
}
