<?php

namespace App\Providers;

use App\Guards\Api\v1\ApiGuard;

use App\Models\Ability;
use App\Models\Account;
use App\Models\Address;
use App\Models\File;
use App\Models\Identity;
use App\Models\Image;
use App\Models\Profile;
use App\Models\Secret;
use App\Models\User;
use App\Models\Verification;
use App\Models\Video;

use App\Policies\Api\v1\AbilityPolicy;
use App\Policies\Api\v1\AccountPolicy;
use App\Policies\Api\v1\AddressPolicy;
use App\Policies\Api\v1\FilePolicy;
use App\Policies\Api\v1\IdentityPolicy;
use App\Policies\Api\v1\ImagePolicy;
use App\Policies\Api\v1\ProfilePolicy;
use App\Policies\Api\v1\SecretPolicy;
use App\Policies\Api\v1\UserPolicy;
use App\Policies\Api\v1\VerificationPolicy;
use App\Policies\Api\v1\VideoPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as BaseAuthServiceProvider;
use Illuminate\Support\Facades\{ Auth, Gate };

class AuthServiceProvider extends BaseAuthServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Ability::class => AbilityPolicy::class,
        Account::class => AccountPolicy::class,
        Address::class => AddressPolicy::class,
        File::class => FilePolicy::class,
        Identity::class => IdentityPolicy::class,
        Image::class => ImagePolicy::class,
        Meta::class => MetaPolicy::class,
        Privilege::class => PrivilegePolicy::class,
        Profile::class => ProfilePolicy::class,
        PersonalAccessToken::class => PersonalAccessTokenPolicy::class,
        Secret::class => SecretPolicy::class,
        User::class => UserPolicy::class,
        Verification::class => VerificationPolicy::class,
        Video::class => VideoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }

    /**
     * @return void
     */
    public function register(): void
    {
        Auth::extend(config('api.guard.name'), function ($app, $name, array $config) {
            return new ApiGuard(config('api.bearer.ttl'));
        });

        Gate::before(function () {
            if (app()->isProduction()) {
                return null;
            }

            return config('security.permissions.disabled') ?: null;
        });
    }
}
