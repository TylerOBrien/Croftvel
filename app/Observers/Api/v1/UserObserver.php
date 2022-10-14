<?php

namespace App\Observers\Api\v1;

use App\Events\Api\v1\User\{ UserAddedToAccount, UserRemovedFromAccount, UserIdentified };
use App\Models\User;

class UserObserver
{
    /**
     * Handle the user "updating" event.
     *
     * @param  \App\Models\User  $user
     *
     * @return void
     */
    public function updating(User $user)
    {
        if ($user->isDirty('account_id')) { // Account id is being changed.
            if ($account = $user->fresh()->account) { // Get instance of previous account.
                event(new UserRemovedFromAccount($user, $account));
            }
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     *
     * @return void
     */
    public function updated(User $user)
    {
        if ($user->wasChanged('identified_at')) {
            event(new UserIdentified($user));
        }

        if ($user->wasChanged('account_id')) {
            if ($account = $user->account) {
                event(new UserAddedToAccount($user, $account));
            }
        }
    }
}
