<?php

namespace App\Casts\Api\v1;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class ProfileFieldValueCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  string  $value
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        switch ($model->type) {
        case 'integer':
            return (int) $value;
        case 'float':
            return (float) $value;
        case 'boolean':
            return (bool) $value;
        case 'date':
            return Date::instance(Carbon::createFromFormat('Y-m-d', $value)->startOfDay());
        case 'time':
            return Date::instance(Carbon::createFromFormat('H:i:s.u', $value)->startOfDay());
        case 'datetime':
            return Date::instance(Carbon::createFromFormat('Y-m-d H:i:s.u', $value)->startOfDay());
        }
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     *
     * @return string
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return strval($value);
    }
}
