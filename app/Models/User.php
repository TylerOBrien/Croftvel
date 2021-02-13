<?php

namespace App\Models;

use App\Events\Api\v1\User\UserCreated;
use App\Traits\Models\{ HasEnabledState, HasFullName, HasProfiles };

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends BaseUser
{
    use Notifiable, HasApiTokens, HasEnabledState, HasFullName, HasProfiles;

    protected $fillable = [
        'account_id',
        'is_active'
    ];

    protected $dispatchesEvents = [
        'created' => UserCreated::class
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
     * @return BelongsToMany
     */
    public function privileges()
    {
        return $this->belongsToMany(Privilege::class)
                    ->using(PrivilegeUser::class);
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
    public function hasAbility(string $ability, string $model)
    {
        $bindings = array_merge([ 'user_id' => $this->id ], compact('ability', 'model'));
        $query = DB::raw('
            SELECT COUNT(abilities.id) as total
            FROM abilities
            JOIN privileges ON privileges.id = abilities.privilege_id
            JOIN privilege_user ON privileges.id = privilege_user.privilege_id
            WHERE privilege_user.user_id = :user_id AND
                (abilities.name = "*" OR abilities.name = :ability) AND
                (abilities.model = "*" OR abilities.model = :model)
            LIMIT 1;');

        return (bool) DB::select($query, $bindings)[0]->total ?? false;
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

        return $this->identities()->where($predicate)->first()->value ?? null;
    }

    /**
     * @return bool
     */
    public function getIdentifiedAttribute()
    {
        return (bool) $this->total_identities_verified;
    }

    /**
     * @return int
     */
    public function getTotalIdentitiesVerifiedAttribute()
    {
        return $this->identities()->whereNotNull('verified_at')->count();
    }
}
