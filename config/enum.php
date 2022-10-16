<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enums
    |--------------------------------------------------------------------------
    |
    | The valid values for all enum columns in the database. These are used
    | during table creation migrations, so the side-effects of modifying
    | enum settings that are already in use must be considered otherwise there
    | will be a risk of truncated data in the database.
    |
    */

    'account' => [
        'status' => array_map(fn ($case) => $case->value, \App\Enums\Account\AccountStatus::cases()),
    ],

    'identity' => [
        'type' => array_map(fn ($case) => $case->value, \App\Enums\Identity\IdentityType::cases()),
    ],

    'oauth' => [
        'provider' => array_map(fn ($case) => $case->value, \App\Enums\OAuth\OAuthProvider::cases()),
    ],

    'profile_field' => [
        'type' => array_map(fn ($case) => $case->value, \App\Enums\Profile\ProfileFieldType::cases()),
    ],

    'secret' => [
        'type' => array_map(fn ($case) => $case->value, \App\Enums\Secret\SecretType::cases()),
    ],

    'verification' => [
        'ability' => array_map(fn ($case) => $case->value, \App\Enums\Verification\VerificationAbility::cases()),
        'type' => array_map(fn ($case) => $case->value, \App\Enums\Verification\VerificationType::cases()),
    ],

];
