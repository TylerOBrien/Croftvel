<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enums
    |--------------------------------------------------------------------------
    |
    | The valid values for all enum columns in the database. These are used
    | during migrations, so the side-effects of modifying existing values must
    | be considered otherwise there will be a risk of truncated data in the
    | database.
    |
    */

    'account' => [
        'status' => array_map(fn ($case) => $case->value, \App\Enums\Account\AccountStatus::cases()),
    ],

    'identity' => [
        'type' => array_map(fn ($case) => $case->value, \App\Enums\Identity\IdentityType::cases()),
    ],

    'oauth' => [
        'type' => array_map(fn ($case) => $case->value, \App\Enums\OAuth\OAuthProvider::cases()),
    ],

    'profile_field' => [
        'type' => [
            'boolean',
            'date',
            'datetime',
            'float',
            'integer',
            'string',
            'time',
        ],
    ],

    'secret' => [
        'type' => array_map(fn ($case) => $case->value, \App\Enums\Secret\SecretType::cases()),
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

];
