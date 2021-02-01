<?php

namespace App\Providers;

use App\Models\{
    Image,
    User };

use App\Policies\Api\v1\{
    ImagePolicy,
    UserPolicy };

use App\Services\Authenticate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Image::class => ImagePolicy::class,
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
        $this->app->bind(Authenticate::class, function($app) {
            return new Authenticate;
        });
    }
}
