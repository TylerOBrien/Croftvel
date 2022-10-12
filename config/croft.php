<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Hosts
    |--------------------------------------------------------------------------
    |
    */

    'hosts' => [
        'api' => env('APP_HOST_API'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Security
    |--------------------------------------------------------------------------
    |
    */

    'token' => [
        'name' => env('APP_TOKEN_NAME', env('APP_NAME', 'Laravel')),
        'ttl' => 10080, /* 7 days */
        'length' => 40,
        'hash_algo' => 'sha256',
    ],

    'recovery' => [
        'ttl' => 60,
        'length' => 12,
    ],

    'verification' => [
        'ttl' => 60,
        'length' => 12,
        'hash_algo' => 'sha256',
    ],

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    */

    'models' => [
        'namespace' => 'App\Models\\',
    ],

    /*
    |--------------------------------------------------------------------------
    | Enums
    |--------------------------------------------------------------------------
    |
    */

    'enum' => [
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
    ],

    /*
    |--------------------------------------------------------------------------
    | Responses
    |--------------------------------------------------------------------------
    |
    */

    'responses' => [
        'key' => [
            'message' => 'message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Response Relationships
    |--------------------------------------------------------------------------
    | These values are passed to Laravel's ->load() or ->with() functions. They are defined
    | here as a convenience and to minimize repeating code.
    */

    'relationships' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Response Attributes
    |--------------------------------------------------------------------------
    | These values are passed to Laravel's ->append() function. They are defined
    | here as a convenience and to minimize repeating code.
    */

    'attributes' => [
        'file' => [
            'index' => [ 'url' ],
            'show' => [ 'url' ],
            'store' => [ 'url' ],
        ],

        'image' => [
            'index' => [ 'url' ],
            'show' => [ 'url' ],
            'store' => [ 'url' ],
        ],
    ],

];
