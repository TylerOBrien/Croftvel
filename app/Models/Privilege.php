<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function abilities()
    {
        return $this->hasMany(Ability::class);
    }

    /**
     * Creates a new privilege and associates it with the given user.
     *
     * @param  \App\Models\User  $user  The user to create the privilege for.
     *
     * @return \App\Models\Privilege
     */
    static public function createForUser(User $user): Privilege
    {
        $privilege = self::create([
            'name' => "user.$user->id",
        ]);

        PrivilegeUser::create([
            'user_id' => $user->id,
            'privilege_id' => $privilege->id,
        ]);

        return $privilege;
    }
}
