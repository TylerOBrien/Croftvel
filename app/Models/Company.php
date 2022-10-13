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
}
