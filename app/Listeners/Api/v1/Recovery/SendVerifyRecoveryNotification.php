<?php

namespace App\Listeners\Api\v1\Recovery;

use App\Events\Api\v1\Recovery\RecoveryCreated;
use App\Models\User;
use App\Notifications\Api\v1\VerifyRecoveryNotification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerifyRecoveryNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user = null)
    {
        $this->user = $user ?? auth()->user();
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\Recovery\RecoveryCreated  $event
     * 
     * @return void
     */
    public function handle(RecoveryCreated $event)
    {
        $this->user->notify(new VerifyRecoveryNotification($event->plaintext_code));
    }
}
