<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
    }

    /**
     * Define the api routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group(
            [
                'prefix' => 'v1',
                'domain' => config('croft.hosts.api')
            ],
            function() {
                Route::middleware('jwt.guest')
                     ->group(base_path('routes/api/v1/guest.php'));

                Route::middleware('jwt.user')
                     ->group(base_path('routes/api/v1/user.php'));

                Route::middleware('jwt.admin')
                     ->group(base_path('routes/api/v1/admin.php'));
            }
        );
    }
}
