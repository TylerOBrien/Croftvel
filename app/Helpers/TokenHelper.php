<?php

namespace App\Helpers;

class TokenHelper
{
    /**
     * @return array
     */
    public static function makeResponse($token)
    {
        return [
            'token' => $token,
            'token_type' => 'Bearer',
            'ttl' => auth()->factory()->getTTL(),
            'ttl_type' => 'minute'
        ];
    }
}
