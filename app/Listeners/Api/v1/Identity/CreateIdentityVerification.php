<?php

namespace App\Listeners\Api\v1\Identity;

use App\Events\Api\v1\Identity\IdentityCreated;
use App\Models\Verification;

class CreateIdentityVerification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\Recovery\IdentityCreated  $event
     * 
     * @return void
     */
    public function handle(IdentityCreated $event)
    {
        if ($event->identity->type !== 'oauth' && !$event->identity->is_verified) {
            Verification::create([
                'identity_id' => $event->identity->id,
                'code' => Verification::makeUniqueInt('code', config('croft.verification.length'), 'sha256') ]);
        }
    }
}
