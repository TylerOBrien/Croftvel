<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Province implements Rule
{
    /**
     * 
     */
    public function passes($attribute, $value)
    {
        return true;
    }

    /**
     * 
     */
    public function message()
    {
        return trans('validation.address.province');
    }
}
