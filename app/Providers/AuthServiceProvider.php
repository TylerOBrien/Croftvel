<?php

namespace App\Providers;

use App\Guards\Api\v1\ApiGuard;

use App\Models\Ability;
use App\Models\Address;
use App\Models\File;
use App\Models\Identity;
use App\Models\Image;
use App\Models\Meta;
use App\Models\PersonalAccessToken;
use App\Models\Privilege;
use App\Models\Profile;
use App\Models\Secret;
use App\Models\User;
use App\Models\Verification;

use App\Policies\Api\v1\AbilityPolicy;
use App\Policies\Api\v1\AddressPolicy;
use App\Policies\Api\v1\FilePolicy;
use App\Policies\Api\v1\IdentityPolicy;
use App\Policies\Api\v1\ImagePolicy;
use App\Policies\Api\v1\MetaPolicy;
use App\Policies\Api\v1\PersonalAccessTokenPolicy;
use App\Policies\Api\v1\PrivilegePolicy;
use App\Policies\Api\v1\ProfilePolicy;
use App\Policies\Api\v1\SecretPolicy;
use App\Policies\Api\v1\UserPolicy;
use App\Policies\Api\v1\VerificationPolicy;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as BaseAuthServiceProvider;

class AuthServiceProvider extends BaseAuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Ability::class => AbilityPolicy::class,
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
        Verification::class => VerificationPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }

    /**
     * @return void
     */
    public function register()
    {
        Auth::extend('croft', function ($app, $name, array $config) {
            return new ApiGuard(config('sanctum.expiration'));
        });
    }
}
