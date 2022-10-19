<?php

namespace App\Observers\Api\v1;

use App\Models\Verification;

class VerificationObserver
{
    /**
     * Handle the verification "creating" event.
     *
     * @param  \App\Models\Verification  $verification
     *
     * @return void
     */
    public function creating(Verification $verification): void
    {
        if (is_null($verification->hash_algo)) {
            $verification->hash_algo = config('verify.default.hash_algo');
        }

        if (is_null($verification->code)) {
            $verification->code = $verification->generate();
        }
    }
}
