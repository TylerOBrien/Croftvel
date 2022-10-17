<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Guard
    |--------------------------------------------------------------------------
    |
    | Settings for the ApiGuard.
    |
    */

    'guard' => [
        'name' => env('SECURITY_GUARD_NAME', 'croft'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Bearer
    |--------------------------------------------------------------------------
    |
    | Settings for the Bearer token provided in the HTTP header.
    |
    */

    'bearer' => [
        'name' => env('APP_TOKEN_NAME', env('APP_NAME', 'Laravel')),
        'ttl' => env('SECURITY_BEARER_TTL', 10080),
        'ttl_type' => env('SECURITY_BEARER_TTL_TYPE', 'minute'), // 10080 minutes = 7 days
        'length' => env('SECURITY_BEARER_LENGTH', 40), // bytes
        'hash_algo' => 'sha256',
    ],

    /*
    |--------------------------------------------------------------------------
    | Recovery
    |--------------------------------------------------------------------------
    |
    | Settings related to account recoveries (i.e. forgot password attempts).
    |
    */

    'recovery' => [
        'ttl' => env('SECURITY_RECOVERY_TTL', 60),
        'length' => env('SECURITY_RECOVERY_LENGTH', 12),
        'hash_algo' => 'sha256',
    ],

    /*
    |--------------------------------------------------------------------------
    | Verification
    |--------------------------------------------------------------------------
    |
    | Settings related to verification attempts, which will typically only be
    | email and/or mobile number verification for newly created accounts.
    |
    */

    'verification' => [
        'ttl' => env('SECURITY_VERIFICATION_TTL', 60),
        'length' => env('SECURITY_VERIFICATION_LENGTH', 12),
        'hash_algo' => 'sha256',
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    |
    | Settings related to permissions/authorization.
    |
    */

    'permissions' => [
        'disabled' => env('SECURITY_PERMISSIONS_DISABLED', 0),
    ],

];
