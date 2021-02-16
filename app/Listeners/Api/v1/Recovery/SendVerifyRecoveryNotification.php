<?php

namespace App\Listeners\Api\v1\Recovery;

use App\Events\Api\v1\Recovery\RecoveryCreated;
use App\Notifications\Api\v1\Recovery\VerifyRecoveryNotification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerifyRecoveryNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\Recovery\RecoveryCreated  $event
     * 
     * @return void
     */
    public function handle(RecoveryCreated $event)
    {
        $event->recovery->identity->user->notify(
            new VerifyRecoveryNotification($event->recovery, $event->plaintext_code)
        );
    }
}
