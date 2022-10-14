<?php

/*
|--------------------------------------------------------------------------
| Enums
|--------------------------------------------------------------------------
|
*/

return [
    'identity' => [
        'type' => [
            'email',
            'mobile',
            'oauth',
        ],
    ],

    'profile_field' => [
        'type' => [
            'boolean',
            'date',
            'datetime',
            'float',
            'integer',
            'time',
        ],
    ],

    'secret' => [
        'type' => [
            'password',
            'totp',
        ],
    ],

    'verification' => [
        'ability' => [
            'store',
            'recover',
            'update',
            'destroy',
        ],

        'type' => [
            'code',
            'token',
        ],
    ],
];
