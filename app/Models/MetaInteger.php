<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaInteger extends Model
{
    protected $fillable = [
        'meta_id',
        'value'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }
}
