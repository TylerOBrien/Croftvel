<?php

namespace App\Listeners\Api\v1\Identity;

use App\Events\Api\v1\Identity\IdentityVerificationCreated;
use App\Notifications\Api\v1\Identity\VerifyIdentityNotification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerifyIdentityNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\Recovery\IdentityVerificationCreated  $event
     *
     * @return void
     */
    public function handle(IdentityVerificationCreated $event)
    {
        $event->identity->user->notify(
            new VerifyIdentityNotification($event->plaintext_code)
        );
    }
}
