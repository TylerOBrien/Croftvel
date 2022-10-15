<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    |
    | The current primary version of the API being used.
    |
    */

    'version' => env('API_VERSION', 'v1'),

    /*
    |--------------------------------------------------------------------------
    | API Hosts
    |--------------------------------------------------------------------------
    |
    | The domain names that are used by the API. These are used to
    | ensure proper routing is used and to support multiple domain names being
    | pointed to this API.
    |
    */

    'hosts' => [
        'v1' => env('API_HOST_V1', env('API_HOST', 'localhost')),
    ],

];
