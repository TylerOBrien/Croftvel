<?php

namespace App\Providers;

use App\Rules\{ Country, Province, MatchesCurrent };

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
        Validator::extendImplicit('country', function($attribute, $value, $parameter, $validator) {
            return (new Country)->passes($attribute, $value);
        });

        Validator::extendImplicit('province', function($attribute, $value, $parameter, $validator) {
            return (new Province)->passes($attribute, $value);
        });

        Validator::extendImplicit('matches_current', function($attribute, $value, $parameter, $validator) {
            return (new MatchesCurrent)->passes($attribute, $value);
        });
    }
}
