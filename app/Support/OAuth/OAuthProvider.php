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
     * @var array<string, \App\Enums\OAuth\OAuthProvider>
     */
    static protected $enums = [
        FacebookProvider::class => OAuthProviderEnum::Facebook,
        GithubProvider::class => OAuthProviderEnum::GitHub,
        GoogleProvider::class => OAuthProviderEnum::Google,
        TwitterProvider::class => OAuthProviderEnum::Twitter,
    ];

    /**
     * Generate an array containing properties for all OAuth providers.
     *
     * @return array
     */
    static public function all(): array
    {
        $providers = [];

        foreach (self::$enums as $class => $enum) {
            $providers[] = [
                'name' => $enum->value,
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
     * @return \App\Enums\OAuth\OAuthProvider|null
     */
    static public function enum(FacebookProvider|GithubProvider|GoogleProvider|TwitterProvider $driver): OAuthProviderEnum|null
    {
        foreach (self::$enums as $class => $enum) {
            if ($driver instanceof $class) {
                return $enum;
            }
        }

        return null;
    }
}
