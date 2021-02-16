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
    | Security
    |--------------------------------------------------------------------------
    | 
    */

    'token' => [
        'name' => env('APP_TOKEN_NAME', env('APP_NAME', 'Laravel'))
    ],

    'recovery' => [
        'ttl' => 60,
        'length' => 32
    ],

    'verification' => [
        'ttl' => 60,
        'length' => 12
    ],

    /*
    |--------------------------------------------------------------------------
    | Uploads
    |--------------------------------------------------------------------------
    | 
    */

    'uploads' => [
        'files' => [
            'disk' => 'public',
            'dir' => 'files'
        ],

        'images' => [
            'disk' => 'public',
            'dir' => 'images'
        ],

        'videos' => [
            'disk' => 'public',
            'dir' => 'videos'
        ],

        'default' => [
            'disk' => 'public',
            'dir' => 'upload'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    | 
    */

    'models' => [
        'namespace' => 'App\Models\\'
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
