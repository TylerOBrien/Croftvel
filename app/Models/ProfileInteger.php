<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileInteger extends Model
{
    protected $fillable = [
        'profile_id',
        'name',
        'value'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
