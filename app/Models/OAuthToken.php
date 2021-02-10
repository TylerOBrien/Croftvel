<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthToken extends Model
{
    protected $fillable = [
        'identity_id',
        'scope',
        'type',
        'value'
    ];

    /**
     * @return BelongsTo
     */
    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }
}
