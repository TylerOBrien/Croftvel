<?php

namespace App\Providers;

use App\Guards\Api\v1\ApiGuard;

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
        //
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
        Gate::before(function() {
            return config('croft.permissions.disabled') ?: null;
        });

        Auth::extend('croft', function ($app, $name, array $config) {
            return new ApiGuard(config('croft.token.ttl'));
        });
    }
}
