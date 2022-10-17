<?php

namespace App\Models;

use App\Events\Api\v1\Token\PersonalAccessTokenCreated;
use App\Support\Token\TokenPlaintextPair;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PersonalAccessToken extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'token',
        'tokenable_id',
        'tokenable_type',
        'abilities',
        'expires_at',
    ];

    protected $hidden = [
        'token',
    ];

    protected $dispatchesEvents = [
        'created' => PersonalAccessTokenCreated::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function tokenable()
    {
        return $this->morphTo();
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new token that the given user identity will be able to use to
     * authenticate.
     *
     * @param  \App\Models\Identity  $identity  The identity that will own the token.
     *
     * @return TokenPlaintextPair
     */
    static public function createForIdentity(Identity $identity): TokenPlaintextPair
    {
        $plaintext = Str::random(config('api.bearer.length'));
        $pat = self::create([
            'name' => config('api.bearer.name'),
            'tokenable_id' => $identity->id,
            'tokenable_type' => Identity::class,
            'token' => hash(config('api.bearer.hash_algo'), $plaintext),
            'abilities' => '["*"]',
        ]);

        return new TokenPlaintextPair($pat, $plaintext);
    }

    /**
     * Attempt to retrieve an instance of the PersonalAccessToken based on the
     * given bearer token value.
     *
     * Will return null if the PersonalAccessToken cannot be found.
     *
     * @param  string  $bearer  The Bearer string provided in the HTTP header.
     *
     * @return \App\Models\PersonalAccessToken|null
     */
    static public function findFromBearer(string $bearer): PersonalAccessToken|null
    {
        if (strpos($bearer, '|') === false) {
            $hashed_token = hash(config('api.bearer.hash_algo'), $bearer);
            return self::where('token', $hashed_token)->first();
        }

        [ $model_id, $plaintext_token ] = explode('|', $bearer, 2);

        if ($instance = self::find($model_id)) {
            $hashed_token = hash(config('api.bearer.hash_algo'), $plaintext_token);
            if (hash_equals($instance->token, $hashed_token)) {
                return $instance;
            }
        }

        return null;
    }
}
