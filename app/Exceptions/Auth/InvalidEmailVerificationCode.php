<?php

namespace App\Exceptions\Auth;

use Exception;

class InvalidEmailVerificationCode extends Exception
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct( trans('auth.email-verification.invalid') );
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
