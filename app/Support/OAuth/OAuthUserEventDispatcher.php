<?php

namespace App\Support\OAuth;

use App\Events\Api\v1\OAuth\{
    FacebookUserIdentified,
    GitHubUserIdentified,
    GoogleUserIdentified,
};

use Laravel\Socialite\Two\{
    FacebookProvider,
    GithubProvider,
    GoogleProvider,
};

class OAuthUserEventDispatcher
{
    /**
     * @param  mixed  $driver  The Socialite provider.
     * @param  mixed  $user  The user identified by the OAuth provider.
     *
     * @return void
     */
    static public function dispatch($driver, $user): void
    {
        if ($driver instanceof FacebookProvider) {
            FacebookUserIdentified::dispatch($driver, $user);
        } else if ($driver instanceof GoogleProvider) {
            GoogleUserIdentified::dispatch($driver, $user);
        } else if ($driver instanceof GithubProvider) {
            GitHubUserIdentified::dispatch($driver, $user);
        }
    }
}
