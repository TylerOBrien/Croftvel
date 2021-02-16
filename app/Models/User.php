<?php

namespace App\Models;

use App\Events\Api\v1\User\UserCreated;
use App\Traits\Models\{ HasEnabledState, HasFullName, HasProfiles, HasUserAbilities };

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;

class User extends BaseUser
{
    use Notifiable, HasApiTokens, HasEnabledState, HasFullName, HasProfiles, HasUserAbilities;

    protected $appends = [
        'is_identified'
    ];

    protected $fillable = [
        'account_id',
        'first_name',
        'middle_name',
        'last_name',
        'is_enabled'
    ];

    protected $dispatchesEvents = [
        'created' => UserCreated::class
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function identities()
    {
        return $this->hasMany(Identity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function privileges()
    {
        return $this->belongsToMany(Privilege::class)
                    ->using(PrivilegeUser::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function secrets()
    {
        return $this->hasMany(Secret::class);
    }

    /**
     * Retreive the primary email address for this user.
     * 
     * @return string|null
     */
    public function getEmailAttribute()
    {
        $predicate = [
            'type' => 'email',
            'name' => 'primary'
        ];

        return $this->identities()
                    ->where($predicate)
                    ->first()
                    ->value ?? null;
    }

    /**
     * Retreive the primary mobile number for this user.
     * 
     * @return string|null
     */
    public function getMobileAttribute()
    {
        $predicate = [
            'type' => 'mobile',
            'name' => 'primary'
        ];

        return $this->identities()
                    ->where($predicate)
                    ->first()
                    ->value ?? null;
    }

    /**
     * @return bool
     */
    public function getIsIdentifiedAttribute()
    {
        return $this->identities()
                    ->whereNotNull('verified_at')
                    ->exists();
    }

    /**
     * @return int
     */
    public function getTotalIdentitiesVerifiedAttribute()
    {
        return $this->identities()
                    ->whereNotNull('verified_at')
                    ->count();
    }
}
