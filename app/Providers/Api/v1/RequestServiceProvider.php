<?php

namespace App\Providers\Api\v1;

use App\Http\Requests\Api\v1\ApiRequest;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->afterResolving(ValidatesWhenResolved::class, function ($resolved) {
            $resolved->validateResolved();
        });

        $this->app->resolving(ApiRequest::class, function ($request, $app) {
            $request = ApiRequest::createFrom($app['request'], $request);
            $request->setContainer($app);
        });
    }
}
