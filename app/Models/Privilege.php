<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function abilities()
    {
        return $this->hasMany(Ability::class);
    }
}
