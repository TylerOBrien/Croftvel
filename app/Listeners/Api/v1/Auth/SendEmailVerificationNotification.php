<?php

namespace App\Listeners\Api\v1\Auth;

use App\Models\EmailVerification;
use App\Events\Api\v1\Auth\RegisterEvent;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailVerificationNotification
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
     * @param  RegisterEvent  $event
     * @return void
     */
    public function handle(RegisterEvent $event)
    {
        if ($event->user instanceof MustVerifyEmail && !$event->user->hasVerifiedEmail()) {
            EmailVerification::create([
                'user_id' => $user->id,
                'code' => random_int(111111, 999999) ]);
            
            $event->user->sendEmailVerificationNotification();
        }
    }
}
