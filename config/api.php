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

];
