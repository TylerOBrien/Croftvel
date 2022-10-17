<?php

namespace App\Support\OAuth;

use App\Enums\Identity\IdentityType;
use App\Exceptions\Api\v1\Identity\IdentityIsntOAuth;
use App\Models\Identity;

use SocialiteProviders\Apple\Provider as AppleProvider;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\{ FacebookProvider, GithubProvider, GoogleProvider, TwitterProvider };

class OAuthDriver
{
    /**
     * @param  \App\Models\Identity  $identity
     *
     * @return string
     */
    static public function token(Identity $identity): string
    {
        if ($identity->type !== IdentityType::OAuth) {
            throw new IdentityIsntOAuth;
        }

        return self::user($identity)->token;
    }

    /**
     * @param  \App\Models\Identity  $identity
     *
     * @return \Laravel\Socialite\Two\User
     */
    static public function user(Identity $identity): \Laravel\Socialite\Two\User
    {
        if ($identity->type !== IdentityType::OAuth) {
            throw new IdentityIsntOAuth;
        }

        return self::get($identity->provider)->stateless()->user();
    }

    /**
     * This is a helper function that exists to prevent false positive linter
     * errors when using the provider returned by Socialite::driver.
     *
     * @param  string  $provider  The name of the OAuth provider.
     *
     * @return \SocialiteProviders\Apple\Provider|\Laravel\Socialite\Two\FacebookProvider|GithubProvider|GoogleProvider|TwitterProvider
     */
    static public function get(string $provider): AppleProvider|FacebookProvider|GithubProvider|GoogleProvider|TwitterProvider
    {
        return Socialite::driver($provider);
    }
}
