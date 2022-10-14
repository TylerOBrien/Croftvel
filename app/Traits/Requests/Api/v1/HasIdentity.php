<?php

namespace App\Traits\Requests\Api\v1;

trait HasIdentity
{
    /**
     * Generate the rule for the identity_id field.
     *
     * @return string
     */
    protected function identityIdRule() : string
    {
        return 'required|int|exists:identities,id';
    }

    /**
     * Generate the rule for the identity.type field.
     *
     * @return string
     */
    protected function identityTypeRule() : string
    {
        return 'required|string|in:' . join(',', config('enum.identity.type'));
    }

    /**
     * Generate the appropriate rule string for the identity.value based on the
     * given identity type.
     *
     * @return string
     */
    protected function identityValueRule() : string
    {
        switch ($this->get('identity.type')) {
        case 'email':
            return '|email';
        default:
            return '';
        }
    }
}
