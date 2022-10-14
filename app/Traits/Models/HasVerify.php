<?php

namespace App\Traits\Models;

use App\Models\Verification;
use App\Exceptions\Api\v1\Verify\{
    AlreadyVerified,
    ExpiredVerificationCode,
    InvalidVerificationAbility,
    InvalidVerificationCode,
    MissingVerificationCode,
    VerificationNotFound,
};

trait HasVerify
{
    /**
     * @param  string  $ability
     * @param  array  $fields
     *
     * @return bool
     */
    public function attemptVerify(string $ability, array $fields) : bool
    {
        if (!in_array($ability, config('enum.verification.ability'))) {
            throw new InvalidVerificationAbility;
        }

        if ($this->is_verified) {
            throw new AlreadyVerified;
        }

        if (!isset($fields['type']) || !isset($fields['value'])) {
            throw new MissingVerificationCode;
        }

        $verifiable_id = $this->id;
        $verification = Verification::where(compact('ability', 'verifiable_id'))->first();

        if (!$verification) {
            throw new VerificationNotFound;
        }

        if ($verification->expires_at && $verification->expires_at->lte(now())) {
            throw new ExpiredVerificationCode;
        }

        call_user_func(
            [ $this, "attemptVerifyBy$fields[type]" ],
            $verification,
            $fields['value'],
        );

        return $this->forceFill([ 'verified_at' => now() ])->save();
    }

    /**
     * @param  \App\Models\Verification  $verification
     * @param  string  $plaintext_code
     *
     * @return void
     */
    protected function attemptVerifyByCode(Verification $verification, string $plaintext_code)
    {
        if (!hash_equals($verification->code, hash('sha256', $plaintext_code))) {
            throw new InvalidVerificationCode;
        }
    }

    /**
     * @param  \App\Models\Verification  $verification
     * @param  string  $token
     *
     * @return void
     */
    protected function attemptVerifyByToken(Verification $verification, string $token)
    {
        if (($this->oauth_token->value ?? null) !== $token) {
            throw new InvalidVerificationCode;
        }
    }
}
