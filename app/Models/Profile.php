<?php

namespace App\Models;

use App\Traits\Models\HasOwnership;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasOwnership;

    protected $hidden = [
        'owner_id',
        'owner_type',
    ];

    protected $fillable = [
        'owner_id',
        'owner_type',
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields()
    {
        return $this->hasMany(ProfileField::class);
    }
}
