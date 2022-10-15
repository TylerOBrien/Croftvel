<?php

namespace App\Models;

use App\Enums\Account\AccountStatus;
use App\Events\Api\v1\Account\AccountCreated;
use App\Traits\Models\HasEnabledState;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasEnabledState;

    protected $casts = [
        'status' => AccountStatus::class,
    ];

    protected $dispatchesEvents = [
        'created' => AccountCreated::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
