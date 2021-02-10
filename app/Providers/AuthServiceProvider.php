<?php

namespace App\Providers;

use App\Guards\Api\v1\ApiGuard;

use App\Models\Address;
use App\Models\AddressPolicy;

use App\Models\Identity;
use App\Models\IdentityPolicy;

use App\Models\PersonalAccessToken;
use App\Models\PersonalAccessTokenPolicy;

use App\Models\User;
use App\Models\UserPolicy;

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
        Address::class => AddressPolicy::class,
        Identity::class => IdentityPolicy::class,
        PersonalAccessToken::class => PersonalAccessTokenPolicy::class,
        User::class => UserPolicy::class
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
     * 
     * 
     * @return void
     */
    public function register()
    {
        Auth::extend('croft', function ($app, $name, array $config) {
            return new ApiGuard(config('sanctum.expiration'));
        });
    }
}
