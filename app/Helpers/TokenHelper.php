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
            'token' => [
                'value' => "Bearer $token",
                'ttl' => auth()->factory()->getTTL(),
                'ttl_type' => 'minute'
            ]
        ];
    }
}
