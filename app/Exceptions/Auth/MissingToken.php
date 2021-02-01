<?php

namespace App\Exceptions\Auth;

use Exception;

class MissingToken extends Exception
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct( trans('auth.token.missing') );
    }

    /**
     * 
     */
    public function render()
    {
        return response()->json([
            config('croft.responses.key.message') => $this->message
        ], 400);
    }
}
