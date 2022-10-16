<?php

namespace App\Enums\Identity;

enum IdentityType: string
{
    case Email = 'email';
    case Mobile = 'mobile';
    case OAuth = 'oauth';
}
