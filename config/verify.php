<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Verification Settings
    |--------------------------------------------------------------------------
    */

    'default' => [
        'ttl' => env('VERIFY_TTL', 60),
        'ttl_type' => env('VERIFY_TTL_TYPE', 'minute'),
        'length' => env('VERIFY_LENGTH', 12),
        'hash_algo' => env('VERIFY_HASH_ALGO', 'sha256'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Identity Verification
    |--------------------------------------------------------------------------
    |
    | Settings related to account identity verifications that are used during
    | user registration and login.
    |
    */

    'identity' => [
        'ttl' => env('VERIFY_IDENTITY_TTL', 60),
        'ttl_type' => env('VERIFY_IDENTITY_TTL_TYPE', 'minute'),
        'length' => env('VERIFY_IDENTITY_LENGTH', 12),
        'hash_algo' => env('VERIFY_IDENTITY_HASH_ALGO', 'sha256'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Recovery Verification
    |--------------------------------------------------------------------------
    |
    | Settings related to account identity verifications that are used during
    | user 'forgot password' attempts.
    |
    */

    'recovery' => [
        'ttl' => env('VERIFY_RECOVERY_TTL', 60),
        'ttl_type' => env('VERIFY_RECOVERY_TTL_TYPE', 'minute'),
        'length' => env('VERIFY_RECOVERY_LENGTH', 12),
        'hash_algo' => env('VERIFY_RECOVERY_HASH_ALGO', 'sha256'),
    ],

];
