<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\{ Hash, Request };

class MatchesCurrent implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $name = "{$attribute}_current";

        if (!Request::has($name)) {
            return false;
        }

        $given = Request::input($name);
        $current = auth()->user()->attributes[$attribute];

        if ($attribute !== 'password') {
            return $given === $current;
        } else {
            return Hash::check($given, $current);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.matches_current');
    }
}
