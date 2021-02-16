<?php

namespace App\Models;

use App\Events\Api\v1\User\UserCreated;
use App\Traits\Models\{ HasEnabledState, HasFullName, HasProfiles };

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class User extends BaseUser
{
    use Notifiable, HasApiTokens, HasEnabledState, HasFullName, HasProfiles;

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
     * @return bool
     */
    public function hasAbility(string $ability, string $model_type, int $model_id = null)
    {
        $model_type = Str::start($model_type, config('croft.models.namespace'));
        $bindings = array_merge([ 'user_id' => $this->id ], compact('ability', 'model_type'));

        if (is_null($model_id)) {
            $model_id_clause = 'abilities.model_id IS NULL';
        } else {
            $bindings['model_id'] = $model_id;
            $model_id_clause = '(abilities.model_id IS NULL OR abilities.model_id = :model_id)';
        }

        $query = DB::raw("
            SELECT EXISTS(SELECT *
            FROM abilities
            JOIN privileges ON privileges.id = abilities.privilege_id
            JOIN privilege_user ON privileges.id = privilege_user.privilege_id
            WHERE privilege_user.user_id = :user_id AND
                (abilities.name = '*' OR abilities.name = :ability) AND
                (abilities.model_type = '*' OR abilities.model_type = :model_type) AND
                $model_id_clause
            LIMIT 1) as `exists`;");

        return (bool) DB::select($query, $bindings)[0]->exists ?? false;
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

        return $this->identities()->where($predicate)->first()->value ?? null;
    }

    /**
     * @return bool
     */
    public function getIsIdentifiedAttribute()
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
