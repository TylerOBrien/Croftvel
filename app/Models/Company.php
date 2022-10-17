<?php

namespace App\Models;

use App\Traits\Models\{ HasAddresses, HasLogo, HasProfiles };

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasAddresses, HasLogo, HasProfiles;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */

    /**
     * @return \App\Models\Address|null
     */
    public function getLocationAttribute(): Address|null
    {
        return $this->addresses()->whereName(config('models.default.name'))->first();
    }
}
