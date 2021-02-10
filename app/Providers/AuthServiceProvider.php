<?php

namespace App\Providers;

use App\Guards\Api\v1\ApiGuard;

use App\Models\Address;
use App\Policies\Api\v1\AddressPolicy;

use App\Models\Identity;
use App\Policies\Api\v1\IdentityPolicy;

use App\Models\PersonalAccessToken as Token;
use App\Policies\Api\v1\PersonalAccessTokenPolicy as TokenPolicy;

use App\Models\User;
use App\Policies\Api\v1\UserPolicy;

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
        Token::class => TokenPolicy::class,
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
     * @return void
     */
    public function register()
    {
        Auth::extend('croft', function ($app, $name, array $config) {
            return new ApiGuard(config('sanctum.expiration'));
        });
    }
}
