<?php

namespace App\Providers;

use App\Guards\Api\v1\ApiGuard;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/';

    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->bindLiteralMeRouteParam();
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
                Route::middleware('croft.guest')
                     ->group(base_path('routes/Api/v1/guest.php'));
                Route::middleware('croft.user')
                     ->group(base_path('routes/Api/v1/user.php'));
            }
        );
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * Implicitly convert all {user} params of 'me' to the currently
     * authenticated user.
     *
     * @return void
     */
    protected function bindLiteralMeRouteParam()
    {
        Route::bind('user', function ($id) {
            return $id === 'me' ? ApiGuard::getInstance()->user() : $id;
        });
    }
}
