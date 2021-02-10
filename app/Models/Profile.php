<?php

namespace App\Models;

use App\Traits\Models\HasOwnership;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasOwnership;

    protected $hidden = [
        'owner_id',
        'owner_type'
    ];

    protected $fillable = [
        'owner_id',
        'owner_type',
        'name'
    ];
    
    /**
     * @return HasMany
     */
    public function floats()
    {
        return $this->hasMany(ProfileFloat::class);
    }

    /**
     * @return HasMany
     */
    public function integers()
    {
        return $this->hasMany(ProfileInteger::class);
    }
    
    /**
     * @return HasMany
     */
    public function strings()
    {
        return $this->hasMany(ProfileString::class);
    }
    
    /**
     * @return HasMany
     */
    public function texts()
    {
        return $this->hasMany(ProfileText::class);
    }
}
