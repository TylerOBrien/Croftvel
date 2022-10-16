<?php

namespace App\Support\OAuth;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\{ FacebookProvider, GithubProvider, GoogleProvider };

class OAuthDriver
{
    /**
     * This is a helper function that exists to prevent false positive linter
     * errors when using the provider returned by Socialite::driver.
     *
     * @param  string  $provider  The name of the OAuth provider.
     *
     * @return \Laravel\Socialite\Two\FacebookProvider|GithubProvider|GoogleProvider
     */
    static public function get(string $provider): FacebookProvider|GithubProvider|GoogleProvider
    {
        return Socialite::driver($provider);
    }
}
