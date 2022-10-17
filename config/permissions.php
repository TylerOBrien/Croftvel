<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Permissions Bypass
    |--------------------------------------------------------------------------
    |
    | This setting will enable the flag that tells the permissions handler to
    | not check any permissions whatsoever and to allow any and all requests
    | from anybody.
    |
    | When in production mode this setting is ignored.
    |
    */

    'bypass' => env('PERMISSIONS_BYPASS_ENABLED', 0),

];
