<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ApiException;

use Illuminate\Support\Str;

class Forbidden extends ApiException
{
    /**
     * Instantiate the exception.
     * 
     * @return void
     */
    public function __construct($ability, $target)
    {
        $namespace = explode('\\', is_string($target) ? $target : get_class($target));
        $model = Str::snake(end($namespace));

        if (is_object($target)) {
            $target = ".$model.{$target->id}";
        } else if ($target) {
            $target = ".$model";
        }

        $attributes = [
            'ability' => $ability,
            'target' => $target
        ];

        parent::__construct(trans('auth.forbidden', $attributes), 403);
    }
}
