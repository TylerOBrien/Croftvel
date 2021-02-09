<?php

namespace App\Models;

use App\Traits\Models\{ HasActiveState, HasFullName };

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;

class User extends BaseUser
{
    use Notifiable, HasApiTokens, HasActiveState, HasFullName;

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
    public function getIdentitiesVerifiedAttribute()
    {
        return $this->identities()
                    ->join('verifications', 'identities.id', '=', 'verifications.identity_id')
                    ->whereNotNull('verifications.verified_at')
                    ->count();
    }

    /**
     * @return bool
     */
    public function getIdentifiedAttribute()
    {
        return (bool) $this->identities_verified;
    }
}
