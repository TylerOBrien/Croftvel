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
     * Attempts to verify this model against the given ability name and
     * verification code field data. This will throw an error if any check
     * fails.
     *
     * @param  string  $ability  The ability (e.g. store or recover) to verify.
     * @param  array  $fields  The field data contaning the verification code to check against.
     *
     * @return bool
     */
    public function verify(string $ability, array $fields): bool
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
            [ $this, "verifyBy$fields[type]" ],
            $verification,
            $fields['value'],
        );

        return $this->forceFill([ 'verified_at' => now() ])->save();
    }

    /**
     * Attempts to verify the verification instance against the plaintext code.
     *
     * @param  \App\Models\Verification  $verification  The verification instance from storage.
     * @param  string  $plaintext_code  The verification code in plaintext.
     *
     * @return void
     */
    protected function verifyByCode(Verification $verification, string $plaintext_code): void
    {
        $plaintext_code = str_replace(['-', '.', ' '], '', $plaintext_code);
        $hashed_code = hash(config('security.verification.hash_algo'), $plaintext_code);

        if (!hash_equals($verification->code, $hashed_code)) {
            throw new InvalidVerificationCode;
        }
    }

    /**
     * @param  \App\Models\Verification  $verification  The verification instance from storage.
     * @param  string  $token
     *
     * @return void
     */
    protected function verifyByToken(Verification $verification, string $token): void
    {
        if (($this->oauth_token->value ?? null) !== $token) {
            throw new InvalidVerificationCode;
        }
    }
}
