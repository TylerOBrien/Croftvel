<?php

namespace App\Observers\Api\v1;

use App\Events\Api\v1\Recovery\RecoveryVerified;
use App\Models\Recovery;

class RecoveryObserver
{
    /**
     * Handle the Identity "updated" event.
     *
     * @param  \App\Models\Identity  $recovery
     * 
     * @return void
     */
    public function updated(Recovery $recovery)
    {
        if ($recovery->wasChanged('verified_at')) {
            event(new RecoveryVerified($recovery));
        } 
    }
}
