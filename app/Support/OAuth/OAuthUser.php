<?php

namespace App\Support\OAuth;

use App\Models\{ GitHubUser, Identity };

use Laravel\Socialite\Two\User as SocialiteUser;

class OAuthUser
{
    /**
     * @param  \App\Models\Identity  $identity
     *
     * @return \App\Models\GitHubUser
     */
    static public function create(Identity $identity): GitHubUser
    {
        $fields = OAuthDriver::get($identity->provider)->stateless()->user();

        switch ($identity->provider) {
        case 'github':
            return self::createGitHub($identity, $fields);
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
}
