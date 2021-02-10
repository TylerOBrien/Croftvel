<?php

namespace App\Models;

use App\Traits\Models\{ HasEnabledState, HasFullName };

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;

class User extends BaseUser
{
    use Notifiable, HasApiTokens, HasEnabledState, HasFullName;

    protected $fillable = [
        'account_id',
        'is_active'
    ];

    /**
     * @return BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return HasMany
     */
    public function identities()
    {
        return $this->hasMany(Identity::class);
    }

    /**
     * @return HasMany
     */
    public function secrets()
    {
        return $this->hasMany(Secret::class);
    }

    /**
     * @return bool
     */
    public function getIdentifiedAttribute()
    {
        return (bool) $this->identities_verified;
    }

    /**
     * @return int
     */
    public function getIdentitiesVerifiedAttribute()
    {
        return $this->identities()->whereNotNull('verified_at')->count();
    }
}
