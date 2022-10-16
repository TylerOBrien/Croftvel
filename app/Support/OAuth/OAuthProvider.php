<?php

namespace App\Support\OAuth;

use App\Enums\OAuth\OAuthProvider as OAuthProviderEnum;
use Laravel\Socialite\Two\{
    FacebookProvider,
    GithubProvider,
    GoogleProvider,
    TwitterProvider,
};

class OAuthProvider
{
    /**
     * Generate an array containing properties for all OAuth providers.
     *
     * @return array
     */
    static public function all(): array
    {
        $providers = [];

        foreach (OAuthProviderEnum::cases() as $provider) {
            $providers[] = [
                'name' => $provider->value,
            ];
        }

        return $providers;
    }

    /**
     * Attempts to retrieve the string-based name of the given OAuth provider.
     * Will return null if the appropriate name cannot be found.
     *
     * @param  \Laravel\Socialite\Two\FacebookProvider|GithubProvider|GoogleProvider|TwitterProvider  $driver  The driver to get the name of.
     *
     * @return string|null
     */
    static public function name(FacebookProvider|GithubProvider|GoogleProvider|TwitterProvider $driver): string|null
    {
        return self::enum($driver)?->value;
    }

    /**
     * Attempts to retrieve the PHP enum for the given OAuth provider.
     * Will return null if the appropriate name cannot be found.
     *
     * @param  \Laravel\Socialite\Two\FacebookProvider|GithubProvider|GoogleProvider|TwitterProvider  $driver  The driver to get the name of.
     *
     * @return OAuthProviderEnum|null
     */
    static public function enum(FacebookProvider|GithubProvider|GoogleProvider|TwitterProvider $driver): OAuthProviderEnum|null
    {
        if ($driver instanceof FacebookProvider) {
            return OAuthProviderEnum::Facebook;
        }

        if ($driver instanceof GithubProvider) {
            return OAuthProviderEnum::GitHub;
        }

        if ($driver instanceof GoogleProvider) {
            return OAuthProviderEnum::Google;
        }

        if ($driver instanceof TwitterProvider) {
            return OAuthProviderEnum::Twitter;
        }

        return null;
    }
}
