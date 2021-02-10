<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    protected $hidden = [
        'code'
    ];

    protected $fillable = [
        'identity_id',
        'code'
    ];

    /**
     * @return BelongsTo
     */
    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }
}
