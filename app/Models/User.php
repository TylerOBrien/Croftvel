<?php

namespace App\Models;

use App\Events\Api\v1\User\UserCreated;
use App\Traits\Models\{ HasEnabledState, HasFullName, HasUserAbilities };

use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;

class User extends BaseUser
{
    use Notifiable, HasEnabledState, HasFullName, HasUserAbilities;

    protected $appends = [
        'is_identified',
    ];

    protected $fillable = [
        'account_id',
        'first_name',
        'middle_name',
        'last_name',
        'is_enabled',
    ];

    protected $dispatchesEvents = [
        'created' => UserCreated::class,
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
     * Retreive the primary email address (if it exists) for this user.
     *
     * @return string|null
     */
    public function getEmailAttribute()
    {
        return $this->identityAttribute('email');
    }

    /**
     * Retreive the primary mobile number (if it exists) for this user.
     *
     * @return string|null
     */
    public function getMobileAttribute()
    {
        return $this->identityAttribute('mobile');
    }

    /**
     * Retreive the user's privilege model.
     *
     * @return Privilege|null
     */
    public function getPrivilegeAttribute()
    {
        return Privilege::whereName("user.$this->id")->first();
    }

    /**
     * Return whether or not this user has been verified/identified.
     *
     * @return bool
     */
    public function getIsIdentifiedAttribute()
    {
        return $this->identities()
                    ->whereNotNull('verified_at')
                    ->exists();
    }

    /**
     * Get the total number of identities that have been verified/identified.
     *
     * @return int
     */
    public function getTotalIdentitiesVerifiedAttribute()
    {
        return $this->identities()
                    ->whereNotNull('verified_at')
                    ->count();
    }

    /**
     * Retreive the specified identity attribute.
     *
     * @param  string  $type  The type of identity (e.g. email or mobile) to lookup.
     * @param  string  $name  The name of the identity.
     *
     * @return string|null
     */
    protected function identityAttribute(string $type, string $name = 'primary')
    {
        return $this->identities()
                    ->where(compact('type', 'name'))
                    ->first()
                    ->value ?? null;
    }

    /**
     * Create a new user model with as well as a new account that the new user
     * will be associated with.
     *
     * @return \App\Models\User
     */
    static public function createWithAccount() : User
    {
        return self::create([
            'account_id' => Account::create()->fresh()->id,
        ]);
    }
}
