<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $fillable = [
        'privilege_id',
        'name',
        'model'
    ];

    /**
     * @return BelongsTo
     */
    public function privilege()
    {
        return $this->belongsTo(Privilege::class);
    }
}
