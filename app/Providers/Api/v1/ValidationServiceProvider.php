<?php

namespace App\Providers\Api\v1;

use App\Rules\{ Can, Country, Province, MatchesCurrent, Morphable, QueryFilter };

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
        Validator::extendImplicit('can', function($attribute, $value, $parameters, $validator) {
            return (new Can($parameters))->passes($attribute, $value);
        });

        Validator::extendImplicit('country', function($attribute, $value, $parameter, $validator) {
            return (new Country)->passes($attribute, $value);
        });

        Validator::extendImplicit('query_filter', function($attribute, $value, $parameters) {
            return (new QueryFilter($parameters))->passes($attribute, $value);
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
