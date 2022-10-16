<?php

namespace App\Http\Resources\Api\v1\OAuth;

use App\Support\OAuth\OAuthProvider;

use Illuminate\Http\Resources\Json\JsonResource;

use Laravel\Socialite\Two\{ FacebookProvider, GithubProvider, GoogleProvider, TwitterProvider };

class OAuthProviderResource extends JsonResource
{
    /**
     * The OAuth provider.
     *
     * @var \App\Enums\OAuth\OAuthProvider
     */
    protected $provider;

    /**
     * Instantiate the resource.
     *
     * @param  \Laravel\Socialite\Two\FacebookProvider|GithubProvider|GoogleProvider|TwitterProvider  $driver
     *
     * @return array
     */
    public function __construct(FacebookProvider|GithubProvider|GoogleProvider|TwitterProvider $driver)
    {
        $this->provider = OAuthProvider::enum($driver);

        parent::__construct($driver);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'url' => $this->redirect()->getTargetUrl(),
        ];
    }
}
