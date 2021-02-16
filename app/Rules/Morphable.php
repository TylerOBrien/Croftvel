<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Morphable implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * 
     * @return bool
     */
    public function passes($attribute, $value)
    {
        [ $column, $name ] = explode('_', strrev($attribute), 2);

        $method = 'passes' . strrev($column);
        $validator = [ $this, $method ];

        if (!method_exists($this, $method)) {
            return false;
        }

        return call_user_func($validator, strrev($name), $value);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     * 
     * @return bool
     */
    protected function passesId($name, $value)
    {
        $model = request("{$name}_type");

        if (strpos($model, 'App\\Models\\') !== 0) {
            $model = "App\\Models\\$model";
        }

        if (!class_exists($model)) {
            return false;
        }

        return (bool) $model::whereId($value)->count();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     * 
     * @return bool
     */
    protected function passesType($name, $value)
    {
        if (strpos($value, 'App\\Models\\') !== 0) {
            $value = "App\\Models\\$value";
        }

        return class_exists($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The given morphable is not valid.';
    }
}
