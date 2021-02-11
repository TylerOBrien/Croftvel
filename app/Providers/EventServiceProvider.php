<?php

namespace App\Providers;

use App\Events\Api\v1\Identity\IdentityCreated;
use App\Events\Api\v1\Recovery\RecoveryCreated;
use App\Events\Api\v1\User\UserIdentified;

use App\Listeners\Api\v1\Identity\SendVerifyIdentityNotification;
use App\Listeners\Api\v1\Recovery\SendVerifyRecoveryNotification;
use App\Listeners\Api\v1\User\SendWelcomeUserNotification;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        IdentityCreated::class => [
            SendVerifyIdentityNotification::class
        ],
        
        RecoveryCreated::class => [
            SendVerifyRecoveryNotification::class
        ],
        
        UserIdentified::class => [
            SendWelcomeUserNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
