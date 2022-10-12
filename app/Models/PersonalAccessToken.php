<?php

namespace App\Models;

use App\Events\Api\v1\Token\PersonalAccessTokenCreated;
use App\Helpers\Token\PersonalAccessTokenHelper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PersonalAccessToken extends Model
{
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function tokenable()
    {
        return $this->morphTo();
    }

    /**
     * Create a new token that the given user will be able to use to authenticate.
     *
     * @param  User  $user  The user who will own the token.
     *
     * @return PersonalAccessTokenHelper
     */
    static public function createForUser(User $user) : PersonalAccessTokenHelper
    {
        $plaintext = Str::random(config('croft.token.length'));
        $pat = self::create([
            'name' => config('croft.token.name'),
            'tokenable_id' => $user->id,
            'tokenable_type' => User::class,
            'token' => hash(config('croft.token.hash_algo'), $plaintext),
            'abilities' => '["*"]',
        ]);

        return new PersonalAccessTokenHelper($pat, $plaintext);
    }

    /**
     * Attempt to retrieve an instance of the PersonalAccessToken based on the
     * given bearer token value.
     *
     * @param  string  $bearer  The bearer token.
     *
     * @return \App\Models\PersonalAccessToken|null
     */
    static public function findFromBearerToken(string $bearer)
    {
        if (strpos($bearer, '|') === false) {
            return self::whereToken(hash(config('croft.token.hash_algo'), $bearer))->first();
        }

        [ $id, $token ] = explode('|', $bearer, 2);

        if ($instance = self::find($id)) {
            return hash_equals($instance->token, hash(config('croft.token.hash_algo'), $token)) ? $instance : null;
        }
    }
}
