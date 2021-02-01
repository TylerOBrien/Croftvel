<?php

namespace App\Exceptions\Auth;

use Exception;

use Illuminate\Support\Str;

class Unauthorized extends Exception
{
    /**
     * 
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

        parent::__construct(
            trans('auth.unauthorized', [
                'ability' => $ability,
                'target' => $target
            ])
        );
    }

    /**
     * 
     */
    public function render()
    {
        return response()->json([
            config('croft.responses.key.message') => $this->message
        ], 403);
    }
}
