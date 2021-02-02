<?php

namespace App\Models;

use App\Traits\Models\{ HasOwnership, HasUserRevisions };

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasOwnership, HasUserRevisions;

    protected $hidden = [
        'owner_id',
        'owner_type'
    ];
    
    protected $fillable = [
        'owner_id',
        'owner_type',
        'name',
        'value'
    ];

    /**
     * 
     */
    public function integers() {
        return $this->hasMany(MetaInteger::class);
    }

    /**
     * 
     */
    public function strings() {
        return $this->hasMany(MetaString::class);
    }
}
