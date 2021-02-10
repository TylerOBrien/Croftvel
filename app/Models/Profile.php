<?php

namespace App\Models;

use App\Traits\Models\HasOwnership;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasOwnership;
    
    /**
     * @return HasMany
     */
    public function floats()
    {
        return $this->hasMany(ProfileFloatEntry::class);
    }

    /**
     * @return HasMany
     */
    public function integers()
    {
        return $this->hasMany(ProfileIntegerEntry::class);
    }
    
    /**
     * @return HasMany
     */
    public function strings()
    {
        return $this->hasMany(ProfileStringEntry::class);
    }
    
    /**
     * @return HasMany
     */
    public function texts()
    {
        return $this->hasMany(ProfileTextEntry::class);
    }
}
