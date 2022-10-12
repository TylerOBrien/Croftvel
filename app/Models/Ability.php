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
     * @param  User  $user
     * @param  array|string  $abilities
     * @param  mixed  $resource
     *
     * @return void
     */
    static public function grant(User $user, $abilities, $resource)
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
