<?php

namespace App\Listeners\Api\v1\Identity;

use App\Events\Api\v1\Identity\IdentityCreated;

use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerifyIdentityNotification implements ShouldQueue
{
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
     * @param  \App\Events\Api\v1\Identity\IdentityCreated  $event
     * 
     * @return void
     */
    public function handle(IdentityCreated $event)
    {
        //
    }
}
