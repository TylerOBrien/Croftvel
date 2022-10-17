<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthAccessToken extends Model
{
    protected $table = 'oauth_access_tokens';

    protected $hidden = [
        'value',
    ];

    protected $fillable = [
        'oauthable_id',
        'oauthable_type',
        'scope',
        'type',
        'value',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function oauthable()
    {
        return $this->morphTo();
    }

    /**
     * @return string
     */
    public function getValueAttribute(): string
    {
        return decrypt($this->attributes['value']);
    }

    /**
     * @param  string  $value
     *
     * @return void
     */
    public function setValueAttribute(string $value)
    {
        $this->attributes['value'] = encrypt($value);
    }
}
