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
    /**
     * This const is expected as part of the Laravel framework but is not actually used.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
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
     * Implicitly convert all {user} params of 'me' to the currently
     * authenticated user.
     *
     * @return void
     */
    protected function bindLiteralMeRouteParam()
    {
        Route::bind('user', function ($id) {
            return $id === 'me' ? ApiGuard::get()->user() : $id;
        });
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
                'domain' => config('app.hosts.api'),
            ],
            function() {
                $hasToken = ApiGuard::get()->hasToken();
                $middlware = 'api.' . ($hasToken ? 'authenticated' : 'guest');
                $path = $hasToken ? 'authenticated.php' : 'routes/Api/v1/guest.php';

                Route::middleware($middlware)->group(base_path($path));
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
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
