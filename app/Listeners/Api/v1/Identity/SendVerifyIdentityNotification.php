<?php

namespace App\Listeners\Api\v1\Identity;

use App\Events\Api\v1\Verification\VerificationCreated;
use App\Notifications\Api\v1\VerifyRecoveryNotification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerifyIdentityNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\Recovery\VerificationCreated  $event
     * 
     * @return void
     */
    public function handle(VerificationCreated $event)
    {
        $event->verification->identity->user->notify(
            new VerifyRecoveryNotification($event->plaintext_code)
        );
    }
}
