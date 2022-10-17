<?php

namespace App\Enums\OAuth;

enum OAuthProvider: string
{
    case Apple = 'apple';
    case Facebook = 'facebook';
    case GitHub = 'github';
    case Google = 'google';
    case Twitter = 'twitter';
}
