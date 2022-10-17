<?php

namespace App\Listeners\Api\v1\OAuth;

use App\Events\Api\v1\Identity\IdentityCreated;
use App\Support\OAuth\OAuthUser;

class CreateOAuthUser
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
        if ($event->identity->is_oauth) {
            if (request()->has('secret.value')) { // Check if there is an OAuth code for this identity before trying to use it.
                OAuthUser::create($event->identity);
            }
        }
    }
}
