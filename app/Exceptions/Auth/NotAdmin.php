<?php

namespace App\Exceptions\Auth;

use Exception;

class NotAdmin extends Exception
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct( trans('auth.not-admin') );
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
