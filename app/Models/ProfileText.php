<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileText extends Model
{
    /**
     * @return BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}