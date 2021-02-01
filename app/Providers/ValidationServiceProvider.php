<?php

namespace App\Providers;

use App\Rules\Country;
use App\Rules\Province;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
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
        Validator::extend('country', function($attribute, $value, $parameter, $validator) {
            return (new Country)->passes($attribute, $value);
        });

        Validator::extend('province', function($attribute, $value, $parameter, $validator) {
            return (new Province)->passes($attribute, $value);
        });
    }
}
