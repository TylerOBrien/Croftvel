<?php

namespace App\Listeners\Api\v1\Identity;

use App\Events\Api\v1\Identity\CreateIdentity;

class SendVerificationNotification
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
     * @param  \App\Events\Api\v1\Identity\CreateIdentity  $event
     * 
     * @return void
     */
    public function handle(CreateIdentity $event)
    {
        //
    }
}
