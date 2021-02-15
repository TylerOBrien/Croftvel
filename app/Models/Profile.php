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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function floats()
    {
        return $this->hasMany(ProfileFloat::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function integers()
    {
        return $this->hasMany(ProfileInteger::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function strings()
    {
        return $this->hasMany(ProfileString::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function texts()
    {
        return $this->hasMany(ProfileText::class);
    }

    /**
     * Retrieve all floats, integers, strings, and texts for this profile.
     * 
     * @return \Illuminate\Support\Collection\Collection
     */
    public function getEntriesAttribute()
    {
        return collect(
            array_merge_recursive(
                $this->floats->keyBy('name')->toArray(),
                $this->integers->keyBy('name')->toArray(),
                $this->strings->keyBy('name')->toArray(),
                $this->texts->keyBy('name')->toArray())
        );
    }
}
