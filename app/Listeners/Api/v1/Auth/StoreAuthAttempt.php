<?php

namespace App\Listeners\Api\v1\Auth;

use App\Events\Api\v1\Auth\AuthAttempted;
use App\Models\AuthAttempt;

class StoreAuthAttempt
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\Auth\AuthAttempted  $event
     *
     * @return void
     */
    public function handle(AuthAttempted $event)
    {
        AuthAttempt::create([
            'identity_type' => $event->identity->type,
            'identity_value' => $event->identity->value,
            'is_success' => $event->is_success,
        ]);
    }
}
