<?php

namespace App\Models;

use App\Support\OAuth\OAuthDriver;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{ Crypt, Hash };

class Secret extends Model
{
    protected $hidden = [
        'value',
    ];

    protected $fillable = [
        'user_id',
        'type',
        'value',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return void
     */
    public function setValueAttribute(string $value)
    {
        switch ($this->type) {
        case 'password':
            $this->attributes['value'] = Hash::make($value);
            break;
        default:
            $this->attributes['value'] = Crypt::encryptString($value);
            break;
        }
    }

    /**
     * Creates a new Secret model using the passed fields that are assumed
     * to have come from a request (e.g. a register request).
     *
     * @param  \App\Models\User  $user
     * @param  array  $fields
     *
     * @return \App\Models\Secret
     */
    static public function createFromFields(User $user, array $fields): Secret
    {
        return self::create([
            'user_id' => $user->id,
            'type' => $fields['secret']['type'],
            'value' =>  $fields['secret']['value'],
        ]);
    }

    /**
     * @param  \App\Models\Identity  $identity
     *
     * @return \App\Models\Secret
     */
    static public function createFromOAuthIdentity(Identity $identity): Secret
    {
        $provider = $identity->provider;
        $oauth_user = OAuthDriver::get($provider)->stateless()->user();

        return self::create([
            'user_id' => $identity->user->id,
            'type' => 'code',
            'value' =>  $oauth_user->token,
        ]);
    }
}
