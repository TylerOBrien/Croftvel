<?php

namespace App\Providers;

use App\Models\{ Identity, User };
use App\Policies\Api\v1\{ IdentityPolicy, UserPolicy };

use App\Guards\Api\v1\ApiGuard;

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
        Identity::class => IdentityPolicy::class,
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
            return new ApiGuard(Auth::createUserProvider($config['provider']), $app->make('request'));
        });
    }
}
