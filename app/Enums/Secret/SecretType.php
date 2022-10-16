<?php

namespace App\Enums\Secret;

enum SecretType: string
{
    case OAuth = 'oauth';
    case Password = 'password';
    case TOTP = 'totp';
}
