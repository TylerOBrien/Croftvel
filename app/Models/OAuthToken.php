<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthToken extends Model
{
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
}
