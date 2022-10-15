<?php

namespace App\Providers;

use App\Events\Api\v1\Auth\AuthAttempted;
use App\Models\{ Identity, User };
use App\Observers\Api\v1\{ IdentityObserver, UserObserver };

use App\Events\Api\v1\Identity\{ IdentityCreated, IdentityVerificationCreated, IdentityVerified };
use App\Listeners\Api\v1\Identity\{ CheckForFirstTimeVerify, CreateIdentityVerification, SendVerifyIdentityNotification };

use App\Events\Api\v1\User\UserIdentified;
use App\Listeners\Api\v1\User\SendWelcomeUserNotification;

use App\Events\Api\v1\User\UserCreated;
use App\Listeners\Api\v1\User\CreateUserPrivilege;

use App\Events\Api\v1\Recovery\RecoveryVerificationCreated;
use App\Listeners\Api\v1\Recovery\SendVerifyRecoveryNotification;

use App\Events\Api\v1\Verification\VerificationCreated;
use App\Listeners\Api\v1\Auth\StoreAuthAttempt;
use App\Listeners\Api\v1\Verification\DispatchCreateVerificationEvent;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The model to observer mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $observers = [
        Identity::class => [
            IdentityObserver::class,
        ],

        User::class => [
            UserObserver::class,
        ],
    ];

    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        AuthAttempted::class => [
            StoreAuthAttempt::class,
        ],

        VerificationCreated::class => [
            DispatchCreateVerificationEvent::class,
        ],

        IdentityCreated::class => [
            CreateIdentityVerification::class,
        ],

        IdentityVerificationCreated::class => [
            SendVerifyIdentityNotification::class,
        ],

        IdentityVerified::class => [
            CheckForFirstTimeVerify::class,
        ],

        RecoveryVerificationCreated::class => [
            SendVerifyRecoveryNotification::class,
        ],

        UserCreated::class => [
            CreateUserPrivilege::class,
        ],

        UserIdentified::class => [
            SendWelcomeUserNotification::class,
        ],
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

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
