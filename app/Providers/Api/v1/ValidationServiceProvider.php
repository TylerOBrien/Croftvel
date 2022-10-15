<?php

namespace App\Providers\Api\v1;

use App\Rules\{
    Can,
    Country,
    IsOrCan,
    MatchesCurrent,
    Morphable,
    Ownable,
    PhoneNumber,
    QueryFilter,
    QuerySorter,
    Subdivision,
};

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * @var array<string, class-string>
     */
    protected $rules = [
        'can' => Can::class,
        'is_or_can' => IsOrCan::class,
        'matches_current' => MatchesCurrent::class,
        'morphable' => Morphable::class,
        'ownable' => Ownable::class,
        'country' => Country::class,
        'subdivision' => Subdivision::class,
        'phone_number' => PhoneNumber::class,
        'query_filter' => QueryFilter::class,
        'query_sorter' => QuerySorter::class,
    ];

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
        foreach ($this->rules as $rule => $class) {
            Validator::extendImplicit($rule, function ($attribute, $value, $parameters, $validator) use ($class) {
                return (new $class($parameters))->passes($attribute, $value);
            });
        }
    }
}
