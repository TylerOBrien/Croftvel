<?php

namespace App\Models;

use App\Enums\Secret\SecretType;
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

    protected $casts = [
        'type' => SecretType::class,
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
        case SecretType::Password:
            $this->attributes['value'] = Hash::make($value);
            break;
        default:
            $this->attributes['value'] = Crypt::encryptString($value);
            break;
        }
    }

    /**
     * Create a new secret instance for the given identity.
     *
     * @param  \App\Models\Identity  $identity
     * @param  array  $fields
     *
     * @return \App\Models\Secret
     */
    static public function createFromIdentity(Identity $identity, array $fields): Secret
    {
        return self::create([
            'user_id' => $identity->user->id,
            'type' => $identity->is_oauth ? SecretType::OAuth : $fields['secret']['type'],
            'value' =>  $identity->is_oauth ? OAuthDriver::user($identity)->token : $fields['secret']['value'],
        ]);
    }
}
