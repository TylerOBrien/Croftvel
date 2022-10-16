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
     *
     * @return void
     */
    static public function dispatch($driver): void
    {
        if ($driver instanceof FacebookProvider) {
            FacebookUserIdentified::dispatch($driver);
        } else if ($driver instanceof GoogleProvider) {
            GoogleUserIdentified::dispatch($driver);
        } else if ($driver instanceof GithubProvider) {
            GitHubUserIdentified::dispatch($driver);
        }
    }
}
