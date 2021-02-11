<?php

namespace App\Listeners\Api\v1\Recovery;

use App\Events\Api\v1\Recovery\CreatedRecovery;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerifyRecoveryNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\Recovery\CreatedRecovery  $event
     * 
     * @return void
     */
    public function handle(CreatedRecovery $event)
    {
        //
    }
}
