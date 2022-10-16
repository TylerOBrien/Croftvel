<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleUser extends Model
{
    protected $fillable = [
        'identity_id',
        'google_id',
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
