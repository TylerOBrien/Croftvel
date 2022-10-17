<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacebookUser extends Model
{
    protected $fillable = [
        'facebook_id',
        'identity_id',
        'email',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }
}
