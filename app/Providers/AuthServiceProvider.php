<?php

namespace App\Providers;

use App\Models\{ Identity, PersonalAccessToken, User };
use App\Policies\Api\v1\{ IdentityPolicy, PersonalAccessTokenPolicy, UserPolicy };

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

        /* Auth::resolved(function ($auth) {
            $auth->extend('croft', function ($app, $name, array $config) use ($auth) {
                return tap($this->createGuard($auth, $config), function ($guard) {
                    $this->app->refresh('request', $guard, 'setRequest');
                });
            });
        }); */
    }

    /**
     * Create the guard,
     *
     * @param \Illuminate\Contracts\Auth\Factory  $auth
     * @param array $config
     * 
     * @return ApiGuard
     */
    protected function createGuard($auth, array $config)
    {
        /* return new RequestGuard(
            new ApiGuard($auth, config('sanctum.expiration'), $config['provider']),
            $this->app['request'],
            $auth->createUserProvider($config['provider'] ?? null)
        ); */
        return new ApiGuard(config('sanctum.expiration'));
    }
}
