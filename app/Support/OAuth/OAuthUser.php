<?php

namespace App\Support\OAuth;

use App\Models\{ GitHubUser, GoogleUser, TwitterUser, Identity };

use Laravel\Socialite\Two\User as SocialiteUser;

class OAuthUser
{
    /**
     * @param  \App\Models\Identity  $identity
     *
     * @return \App\Models\GitHubUser|GoogleUser|TwitterUser
     */
    static public function create(Identity $identity): GitHubUser|GoogleUser|TwitterUser
    {
        $fields = OAuthDriver::user($identity);

        switch ($identity->provider) {
        case 'github':
            return self::createGitHub($identity, $fields);
        case 'google':
            return self::createGoogle($identity, $fields);
        case 'twitter':
            return self::createTwitter($identity, $fields);
        }
    }

    /**
     * @param  \App\Models\Identity  $identity
     * @param  \Laravel\Socialite\Two\User  $fields
     *
     * @return \App\Models\GitHubUser
     */
    static public function createGitHub(Identity $identity, SocialiteUser $fields): GitHubUser
    {
        return GitHubUser::create([
            'identity_id' => $identity->id,
            'github_id' => $fields->id,
            'avatar_url' => $fields->avatar,
            'login' => $fields->nickname,
            'email' => $fields->email,
        ]);
    }

    /**
     * @param  \App\Models\Identity  $identity
     * @param  \Laravel\Socialite\Two\User  $fields
     *
     * @return \App\Models\GoogleUser
     */
    static public function createGoogle(Identity $identity, SocialiteUser $fields): GoogleUser
    {
        return GoogleUser::create([
            'identity_id' => $identity->id,
            'google_id' => $fields->id,
            'nickname' => $fields->nickname,
            'profile_image_url' => $fields->avatar,
        ]);
    }

    /**
     * @param  \App\Models\Identity  $identity
     * @param  \Laravel\Socialite\Two\User  $fields
     *
     * @return \App\Models\TwitterUser
     */
    static public function createTwitter(Identity $identity, SocialiteUser $fields): TwitterUser
    {
        return TwitterUser::create([
            'identity_id' => $identity->id,
            'twitter_id' => $fields->id,
            'nickname' => $fields->nickname,
            'profile_image_url' => $fields->avatar,
        ]);
    }
}
