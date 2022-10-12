<?php

namespace App\Models;

use App\Casts\Api\v1\ProfileFieldValueCast;

use Illuminate\Database\Eloquent\Model;

class ProfileField extends Model
{
    protected $fillable = [
        'profile_id',
        'type',
        'name',
        'value',
    ];

    protected $casts = [
        'value' => ProfileFieldValueCast::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
