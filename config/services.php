<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'facebook' => [
        'client_id' => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect' => env('FACEBOOK_OAUTH_PROVIDER_URL', env('OAUTH_PROVIDERS_URL', 'http://localhost')) . '/facebook/user',
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => env('GITHUB_OAUTH_PROVIDER_URL', env('OAUTH_PROVIDERS_URL', 'http://localhost')) . '/github/user',
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_OAUTH_PROVIDER_URL', env('OAUTH_PROVIDERS_URL', 'http://localhost')) . '/google/user',
    ],

    'linkedin' => [
        'domain' => env('LINKEDIN_CLIENT_ID'),
        'secret' => env('LINKEDIN_CLIENT_SECRET'),
        'redirect' => env('LINKEDIN_OAUTH_PROVIDER_URL', env('OAUTH_PROVIDERS_URL', 'http://localhost')) . '/linkedin/user',
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'twitter' => [
        'key' => env('TWITTER_API_KEY'),
        'secret' => env('TWITTER_API_SECRET'),
        'oauth' => 2,
        'client_id' => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect' => env('TWITTER_OAUTH_PROVIDER_URL', env('OAUTH_PROVIDERS_URL', 'http://localhost')) . '/twitter/user',
    ],

];
