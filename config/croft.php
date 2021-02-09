<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Hosts
    |--------------------------------------------------------------------------
    |
    */

    'hosts' => [
        'api' => env('APP_HOST_API')
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication and Verification
    |--------------------------------------------------------------------------
    | 
    */

    'token' => [
        'name' => env('APP_TOKEN_NAME', env('APP_NAME', 'Laravel'))
    ],

    'verification' => [
        'ttl' => 60
    ],

    /*
    |--------------------------------------------------------------------------
    | Uploads
    |--------------------------------------------------------------------------
    | 
    */

    'uploads' => [
        'disk' => 'public',
        'dir' => [
            'files' => 'files',
            'images' => 'images'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Enums
    |--------------------------------------------------------------------------
    | 
    */

    'enum' => [
        
    ],

    /*
    |--------------------------------------------------------------------------
    | Responses
    |--------------------------------------------------------------------------
    |
    */

    'responses' => [
        'key' => [
            'message' => 'message'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Response Relationships
    |--------------------------------------------------------------------------
    | These values are passed to Laravel's ->load() or ->with() functions. They are defined
    | here as a convenience and to minimize repeating code.
    */

    'relationships' => [
        'address' => [
            'index' => [],
            'show'  => [],
            'store' => []
        ],

        'file' => [
            'index' => [],
            'show' => [],
            'store' => []
        ],

        'image' => [
            'index' => [],
            'show' => [],
            'store' => []
        ],

        'meta' => [
            'index' => [],
            'show'  => [],
            'store' => []
        ],

        'user' => [
            'index' => [],
            'show' =>  [],
            'store' => []
        ]
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Response Attributes
    |--------------------------------------------------------------------------
    | These values are passed to Laravel's ->append() function. They are defined
    | here as a convenience and to minimize repeating code.
    */

    'attributes' => [
        'address' => [
            'index' => [],
            'show'  => [],
            'store' => []
        ],

        'file' => [
            'index' => [ 'url' ],
            'show' => [ 'url' ],
            'store' => [ 'url' ]
        ],

        'image' => [
            'index' => [ 'url' ],
            'show' => [ 'url' ],
            'store' => [ 'url' ]
        ],

        'meta' => [
            'index' => [],
            'show'  => [],
            'store' => []
        ],

        'user' => [
            'index' => [],
            'show' => [],
            'store' => []
        ]
    ]

];
