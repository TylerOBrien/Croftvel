<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaString extends Model
{   
    protected $fillable = [
        'meta_id',
        'value'
    ];

    /**
     * @return BelongsTo
     */
    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }
}
