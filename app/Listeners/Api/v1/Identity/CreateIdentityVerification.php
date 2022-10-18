<?php

namespace App\Listeners\Api\v1\Identity;

use App\Enums\Identity\IdentityType;
use App\Events\Api\v1\Identity\IdentityCreated;
use App\Models\{ Identity, Verification };

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
        if ($event->identity->type !== IdentityType::OAuth && !$event->identity->is_verified) {
            Verification::create([
                'ability' => 'store',
                'verifiable_id' => $event->identity->id,
                'verifiable_type' => Identity::class,
            ]);
        }
    }
}
