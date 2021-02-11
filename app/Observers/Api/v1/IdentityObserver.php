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
     * @return void
     */
    public function updated(Identity $identity)
    {
        if ($identity->wasChanged('verified_at')) {
            event(new IdentityVerified($identity));
        } 
    }
}
