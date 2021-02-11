<?php

namespace App\Models;

use App\Traits\Models\{ HasUniqueCode, HasUniqueMaker };

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasUniqueCode, HasUniqueMaker;

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
