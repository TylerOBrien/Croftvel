<?php

namespace App\Support\OAuth;

use App\Models\Identity;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\{
    User as SocialiteUser,
    FacebookProvider,
    GithubProvider,
    GoogleProvider,
    TwitterProvider,
};

class OAuthDriver
{
    /**
     * @param  \App\Models\Identity  $identity
     *
     * @return string
     */
    static public function token(Identity $identity): string
    {
        return self::user($identity)->token;
    }

    /**
     * @param  \App\Models\Identity  $identity
     *
     * @return \Laravel\Socialite\Two\User
     */
    static public function user(Identity $identity): SocialiteUser
    {
        return OAuthDriver::get($identity->provider)->stateless()->user();
    }

    /**
     * This is a helper function that exists to prevent false positive linter
     * errors when using the provider returned by Socialite::driver.
     *
     * @param  string  $provider  The name of the OAuth provider.
     *
     * @return \Laravel\Socialite\Two\FacebookProvider|GithubProvider|GoogleProvider|TwitterProvider
     */
    static public function get(string $provider): FacebookProvider|GithubProvider|GoogleProvider|TwitterProvider
    {
        return Socialite::driver($provider);
    }
}
