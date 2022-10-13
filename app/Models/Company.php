<?php

namespace App\Models;

use App\Traits\Models\{ HasAddresses, HasProfiles };

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasAddresses, HasProfiles;

    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function location()
    {
        return $this->addresses()->whereName('primary');
    }
}
