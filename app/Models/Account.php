<?php

namespace App\Models;

use App\Traits\Models\HasEnabledState;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasEnabledState;
    
    /**
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
