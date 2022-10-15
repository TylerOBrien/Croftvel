<?php

namespace App\Observers\Api\v1;

use App\Events\Api\v1\Identity\IdentityVerified;
use App\Models\Identity;

class IdentityObserver
{
    /**
     * Handle the Identity "updated" event.
     *
     * @param  \App\Models\Identity  $identity
     *
     * @return void
     */
    public function updated(Identity $identity): void
    {
        if ($identity->verified_at && $identity->wasChanged('verified_at')) {
            IdentityVerified::dispatch($identity);
        }
    }
}
