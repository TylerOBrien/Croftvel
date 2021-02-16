<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthAccessToken extends Model
{
    protected $table = 'oauth_access_tokens';

    protected $hidden = [
        'value'
    ];

    protected $fillable = [
        'identity_id',
        'scope',
        'type',
        'value'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }

    /**
     * @return string
     */
    public function getValueAttribute()
    {
        return decrypt($this->attributes['value']);
    }

    /**
     * @return void
     */
    public function setValueAttribute(string $value)
    {
        $this->attributes['value'] = encrypt($value);
    }
}
