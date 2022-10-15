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
    public function updating(User $user): void
    {
        if ($user->isDirty('account_id')) { // Account id is being changed.
            if ($account = $user->fresh()->account) { // Get instance of previous account.
                UserRemovedFromAccount::dispatch($user, $account);
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
    public function updated(User $user): void
    {
        if ($user->wasChanged('identified_at')) {
            UserIdentified::dispatch($user);
        }

        if ($user->wasChanged('account_id')) {
            if ($account = $user->account) { // Check if account exists. Could be null.
                UserAddedToAccount::dispatch($user, $account);
            }
        }
    }
}
