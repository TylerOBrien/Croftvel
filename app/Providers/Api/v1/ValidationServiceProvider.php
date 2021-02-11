<?php

namespace App\Providers\Api\v1;

use App\Rules\{ Country, Province, MatchesCurrent, Morphable };

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
            return (new Province($parameter))->passes($attribute, $value);
        });

        Validator::extendImplicit('matches_current', function($attribute, $value, $parameter, $validator) {
            return (new MatchesCurrent)->passes($attribute, $value);
        });

        Validator::extendImplicit('morphable', function($attribute, $value, $parameter, $validator) {
            return (new Morphable)->passes($attribute, $value);
        });
    }
}
