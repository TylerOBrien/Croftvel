<?php

namespace App\Exceptions\Auth;

use Exception;

class ExpiredToken extends Exception
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct( trans('auth.token.expired') );
    }

    /**
     * 
     */
    public function render()
    {
        return response()->json([
            config('croft.responses.key.message') => $this->message
        ], 401);
    }
}
