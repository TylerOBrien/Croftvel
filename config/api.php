<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    |
    | The current primary version of the API.
    |
    */

    'version' => 'v' . env('API_VERSION', '1'),

    /*
    |--------------------------------------------------------------------------
    | API Domain Names
    |--------------------------------------------------------------------------
    |
    | The domain names that are used by the API. These exist to ensure proper
    | routing is used and to support multiple domain names being pointed to
    | this API.
    |
    */

    'domains' => [
        'v1' => env('API_DOMAIN_V1', env('API_DOMAIN', 'localhost')),
    ],

    /*
    |--------------------------------------------------------------------------
    | API Guard
    |--------------------------------------------------------------------------
    */

    'guard' => [
        'name' => env('API_GUARD_NAME', 'croft'),
    ],

    /*
    |--------------------------------------------------------------------------
    | API Bearer
    |--------------------------------------------------------------------------
    |
    | Settings for the Bearer token provided in the HTTP header.
    |
    */

    'bearer' => [
        'name' => env('API_BEARER_NAME', env('APP_NAME', 'Croftvel')),
        'ttl' => env('API_BEARER_TTL', 10080),
        'ttl_type' => env('API_BEARER_TTL_TYPE', 'minute'), // 10080 minutes = 7 days
        'length' => env('API_BEARER_LENGTH', 40),
        'hash_algo' => env('API_BEARER_HASH_ALGO', 'sha256'),
    ]

];
