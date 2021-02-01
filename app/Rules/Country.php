<?php

namespace App\Rules;

use Exception;

use League\ISO3166\ISO3166;

use Illuminate\Contracts\Validation\Rule;

class Country implements Rule
{
    /**
     * 
     */
    public function passes($attribute, $value)
    {
        $iso = new ISO3166;

        try {
            $iso->name($value);
            return true;
        } catch (Exception $error) {}

        try {
            $iso->alpha2($value);
            return true;
        } catch (Exception $error) {}

        try {
            $iso->alpha3($value);
            return true;
        } catch (Exception $error) {}

        return false;
    }

    /**
     * 
     */
    public function message()
    {
        return trans('validation.address.country');
    }
}
