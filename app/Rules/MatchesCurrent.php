<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MatchesCurrent implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     *
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        $name = "{$attribute}_current";

        if (!request()->has($name)) {
            return false;
        }

        $given = request($name);
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
    public function message() : string
    {
        return trans('validation.matches_current');
    }
}
