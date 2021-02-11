<?php

namespace App\Providers;

use App\Events\Api\v1\Identity\CreateIdentity;
use App\Events\Api\v1\Recovery\RecoveryCreated;

use App\Listeners\Api\v1\Identity\SendVerificationNotification;
use App\Listeners\Api\v1\Recovery\SendVerifyRecoveryNotification;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CreateIdentity::class => [
            SendVerificationNotification::class
        ],
        
        RecoveryCreated::class => [
            SendVerifyRecoveryNotification::class
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
