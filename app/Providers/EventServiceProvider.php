<?php

namespace App\Providers;

use App\Events\Api\v1\Identity\{ IdentityCreated, IdentityVerified };
use App\Events\Api\v1\Recovery\RecoveryCreated;
use App\Events\Api\v1\User\UserIdentified;
use App\Events\Api\v1\Verification\VerificationCreated;

use App\Listeners\Api\v1\Identity\{ CheckForFirstTimeVerify, CreateIdentityVerification, SendVerifyIdentityNotification };
use App\Listeners\Api\v1\Recovery\SendVerifyRecoveryNotification;
use App\Listeners\Api\v1\User\SendWelcomeUserNotification;

use App\Models\{ Identity, Recovery, User };
use App\Observers\Api\v1\{ IdentityObserver, RecoveryObserver, UserObserver };

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
            CreateIdentityVerification::class
        ],

        IdentityVerified::class => [
            CheckForFirstTimeVerify::class
        ],

        RecoveryCreated::class => [
            SendVerifyRecoveryNotification::class
        ],
        
        UserIdentified::class => [
            SendWelcomeUserNotification::class
        ],

        VerificationCreated::class => [
            SendVerifyIdentityNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Identity::observe(IdentityObserver::class);
        Recovery::observe(RecoveryObserver::class);
        User::observe(UserObserver::class);
    }
}
