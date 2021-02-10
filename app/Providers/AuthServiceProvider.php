<?php

namespace App\Providers;

use App\Models\{ Identity, User };
use App\Policies\Api\v1\{ IdentityPolicy, UserPolicy };

use App\Guards\Api\v1\ApiGuard;

use Illuminate\Auth\RequestGuard;
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
     * 
     * 
     * @return void
     */
    public function register()
    {
        Auth::resolved(function ($auth) {
            $auth->extend('croft', function ($app, $name, array $config) use ($auth) {
                return tap($this->createGuard($auth, $config), function ($guard) {
                    $this->app->refresh('request', $guard, 'setRequest');
                });
            });
        });
    }

    /**
     * Create the guard,
     *
     * @param \Illuminate\Contracts\Auth\Factory  $auth
     * @param array $config
     * 
     * @return ApiGuard
     */
    protected function createGuard($auth, $config)
    {
        return new ApiGuard($auth, config('sanctum.expiration'), $config['provider']);
    }
}
