<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterUser extends Model
{
    protected $fillable = [
        'identity_id',
        'twitter_id',
        'nickname',
        'email',
        'profile_image_url',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }
}
