<?php

namespace App\Models;

use App\Events\Api\v1\Account\{ AbilitiesGivenToUser, AbilitiesTakenFromUser };

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $fillable = [
        'privilege_id',
        'name',
        'model_id',
        'model_type',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function privilege()
    {
        return $this->belongsTo(Privilege::class);
    }

    /**
     * Grant the user the defined ability/abilities. This will allow the user
     * to perform actions on a model.
     *
     * @param  \App\Models\User  $user  The user to grant a permission to.
     * @param  string|\Illuminate\Database\Eloquent\Model  $resource  The resource the ability will apply to.
     * @param  array|string  $abilities  The ability to allow for the user.
     *
     * @return void
     */
    static public function allow(User $user, $resource, array|string $abilities) : void
    {
        $privilege = $user->privilege;

        if (is_string($abilities)) {
            $abilities = [ $abilities ];
        }

        foreach ($abilities as $ability) {
            $instances[] = self::create([
                'name' => $ability,
                'privilege_id' => $privilege->id,
                'model_id' => is_string($resource) ? null : $resource->id,
                'model_type' => is_string($resource) ? $resource : $resource::class,
            ]);
        }

        event(new AbilitiesGivenToUser($user, $resource, $abilities));
    }

    /**
     * Remove any existing permissions previously granted to the user for the
     * defined ability/abilities. This will disallow the user from performing
     * actions on models.
     *
     * @param  \App\Models\User  $user  The user to remove permission from.
     * @param  string|\Illuminate\Database\Eloquent\Model  $resource  The resource the ability had been applied to.
     * @param  array|string  $abilities  The ability to remove from the user.
     *
     * @return void
     */
    static public function disallow(User $user, $resource, array|string $abilities) : void
    {
        $privilege = $user->privilege;

        if (is_string($abilities)) {
            $abilities = [ $abilities ];
        }

        foreach ($abilities as $ability) {
            $model_id = is_string($resource) ? null : $resource->id;
            $query = self::where([
                'name' => $ability,
                'privilege_id' => $privilege->id,
                'model_type' => is_string($resource) ? $resource : $resource::class,
            ]);

            if (is_null($model_id)) {
                $query->whereNull('model_id')->delete();
            } else {
                $query->where('model_id', $model_id)->delete();
            }
        }

        event(new AbilitiesTakenFromUser($user, $resource, $abilities));
    }
}
