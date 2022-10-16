<?php

namespace App\Enums\OAuth;

enum OAuthProvider: string
{
    case Facebook = 'facebook';
    case GitHub = 'github';
    case Google = 'google';
    case LinkedIn = 'linkedin';
    case Twitter = 'twitter';
}
