<?php

namespace App\Observers\Api\v1;

use App\Events\Api\v1\User\UserIdentified;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if ($user->wasChanged('identified_at')) {
            event(new UserIdentified($user));
        } 
    }
}
