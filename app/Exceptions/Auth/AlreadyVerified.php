<?php

namespace App\Exceptions\Auth;

use Exception;

class AlreadyVerified extends Exception
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct( trans('auth.email-verification.already-verified') );
    }

    /**
     * 
     */
    public function render()
    {
        return response()->json([
            config('croft.responses.key.message') => $this->message
        ], 422);
    }
}
