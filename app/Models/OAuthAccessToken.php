<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthAccessToken extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

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

    protected $casts = [
        'value' => 'encrypted',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function oauthable()
    {
        return $this->morphTo();
    }
}
