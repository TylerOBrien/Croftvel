<?php

namespace App\Policies\Api\v1;

use App\Models\{ Privilege, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class PrivilegePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any privileges.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Privilege::class);
    }

    /**
     * Determine whether the user can view the privilege.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Privilege  $privilege
     * 
     * @return mixed
     */
    public function show(User $user, Privilege $privilege)
    {
        return $user->hasAbility('show', Privilege::class);
    }

    /**
     * Determine whether the user can create privileges.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', Privilege::class);
    }

    /**
     * Determine whether the user can update the privilege.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Privilege  $privilege
     * 
     * @return mixed
     */
    public function update(User $user, Privilege $privilege)
    {
        return $user->hasAbility('update', Privilege::class);
    }

    /**
     * Determine whether the user can delete the privilege.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Privilege  $privilege
     * 
     * @return mixed
     */
    public function destroy(User $user, Privilege $privilege)
    {
        return $user->hasAbility('destroy', Privilege::class);
    }
}
