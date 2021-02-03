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
    | Uploads
    |--------------------------------------------------------------------------
    | 
    */

    'uploads' => [
        'disk' => 'public',
        'dir' => [
            'images' => 'images'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Privileges
    |--------------------------------------------------------------------------
    | The enums associated with the given privilege. All enums listed here must
    | be fined in the enums below.
    */

    'privileges' => [
        'admin' => [
            'Admin'
        ],
        'user' => [
            'User'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Enums
    |--------------------------------------------------------------------------
    | Migrations depend on these values. Don't change these without being
    | aware of the side-effects.
    */

    'enum' => [
        'user' => [
            'status' => [
                'Ok',
                'Suspended',
                'Unverified'
            ],
            'type' => [
                'Admin',
                'User'
            ]
        ]
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

        'image' => [
            'index' => [ 'url' ],
            'show' => [ 'url' ],
            'store' => []
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
