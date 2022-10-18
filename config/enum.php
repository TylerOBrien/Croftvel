<?php

use App\Support\Enum;

return [

    /*
    |--------------------------------------------------------------------------
    | Enums
    |--------------------------------------------------------------------------
    |
    | The values for all enum columns in the database.
    |
    | These are used in table creation migrations, so the side-effects of
    | modifying enum settings that are already in use must be considered
    | otherwise there will be a risk of truncated data in the database.
    |
    */

    'account' => [
        'status' => Enum::values(\App\Enums\Account\AccountStatus::class),
    ],

    'identity' => [
        'type' => Enum::values(\App\Enums\Identity\IdentityType::class),
    ],

    'image' => [
        'orientation' => Enum::values(\App\Enums\Image\ImageOrientation::class),
    ],

    'oauth' => [
        'provider' => Enum::values(\App\Enums\OAuth\OAuthProvider::class),
    ],

    'profile_field' => [
        'type' => Enum::values(\App\Enums\Profile\ProfileFieldType::class),
    ],

    'secret' => [
        'type' => Enum::values(\App\Enums\Secret\SecretType::class),
    ],

    'upload' => [
        'disk' => Enum::values(\App\Enums\Upload\UploadDisk::class),
    ],

    'verification' => [
        'ability' => Enum::values(\App\Enums\Verification\VerificationAbility::class),
        'type' => Enum::values(\App\Enums\Verification\VerificationType::class),
    ],

];
