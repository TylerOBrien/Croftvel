<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileString extends Model
{
    protected $fillable = [
        'profile_id',
        'name',
        'value'
    ];
    
    /**
     * @return BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
