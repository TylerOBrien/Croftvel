<?php

namespace App\Listeners\Api\v1\Identity;

use App\Events\Api\v1\Identity\IdentityVerified;

class CheckForFirstTimeVerify
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\Recovery\IdentityVerified  $event
     *
     * @return void
     */
    public function handle(IdentityVerified $event)
    {
        if (is_null($event->identity->user->identified_at)) {
            $event->identity->user->identified_at = now();
            $event->identity->user->save();
        }
    }
}
