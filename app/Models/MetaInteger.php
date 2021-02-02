<?php

namespace App\Models;

use App\Traits\Models\HasUserRevisions;

use Illuminate\Database\Eloquent\Model;

class MetaInteger extends Model
{
    use HasUserRevisions;
    
    protected $fillable = [
        'meta_id',
        'value'
    ];
    
    /**
     * 
     */
    public function meta() {
        return $this->belongsTo(Meta::class);
    }
}
