<?php

namespace App\Listeners\Api\v1\User;

use App\Events\Api\v1\User\UserCreated;
use App\Models\Privilege;

class CreateUserPrivilege
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\User\UserIdentified  $event
     *
     * @return void
     */
    public function handle(UserCreated $event)
    {
        Privilege::createForUser($event->user);
    }
}
