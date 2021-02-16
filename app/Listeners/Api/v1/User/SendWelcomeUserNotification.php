<?php

namespace App\Listeners\Api\v1\User;

use App\Events\Api\v1\User\UserIdentified;
use App\Notifications\Api\v1\User\WelcomeNotification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeUserNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\User\UserIdentified  $event
     * 
     * @return void
     */
    public function handle(UserIdentified $event)
    {
        $event->user->notify(new WelcomeNotification);
    }
}
