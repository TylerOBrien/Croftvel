<?php

namespace App\Providers;

use App\Events\Api\v1\Identity\CreateIdentity;
use App\Listeners\Api\v1\Identity\SendVerificationNotification;

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
