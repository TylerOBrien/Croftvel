<?php

return [

    'defaults' => [
        'guard' => 'croft',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
            'hash' => false,
        ],
        'croft' => [
            'driver' => 'croft',
            'provider' => 'users',
            'hash' => false,
        ]
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
