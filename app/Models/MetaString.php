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
     * 
     */
    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }
}
