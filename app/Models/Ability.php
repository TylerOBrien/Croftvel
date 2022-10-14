<?php

namespace App\Models;

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
     * @param  \Illuminate\Database\Eloquent\Model  $resource  The resource the ability will apply to.
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
            self::create([
                'name' => $ability,
                'privilege_id' => $privilege->id,
                'model_id' => is_string($resource) ? null : $resource->id,
                'model_type' => is_string($resource) ? $resource : $resource::class,
            ]);
        }
    }
}
