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

    'identity' => [
        'type' => [
            'email',
            'mobile',
            'oauth',
        ],
    ],

    'profile_field' => [
        'type' => [
            'boolean',
            'date',
            'datetime',
            'float',
            'integer',
            'time',
        ],
    ],

    'secret' => [
        'type' => [
            'password',
            'totp',
        ],
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