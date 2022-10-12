<?php

namespace App\Listeners\Api\v1\Recovery;

use App\Events\Api\v1\Recovery\RecoveryVerificationCreated;
use App\Notifications\Api\v1\Recovery\VerifyRecoveryNotification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerifyRecoveryNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\Recovery\RecoveryVerificationCreated  $event
     *
     * @return void
     */
    public function handle(RecoveryVerificationCreated $event)
    {
        $event->identity->user->notify(
            new VerifyRecoveryNotification($event->identity, $event->plaintext_code)
        );
    }
}
