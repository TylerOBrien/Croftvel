<?php

namespace App\Policies\Api\v1;

use App\Models\{ Ability, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class AbilityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any abilities.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Ability::class);
    }

    /**
     * Determine whether the user can view the ability.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ability  $ability
     * 
     * @return mixed
     */
    public function show(User $user, Ability $ability)
    {
        return $user->hasAbility('show', Ability::class);
    }

    /**
     * Determine whether the user can create abilities.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return true;
        return $user->hasAbility('store', Ability::class);
    }

    /**
     * Determine whether the user can update the ability.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ability  $ability
     * 
     * @return mixed
     */
    public function update(User $user, Ability $ability)
    {
        return $user->hasAbility('update', Ability::class);
    }

    /**
     * Determine whether the user can delete the ability.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ability  $ability
     * 
     * @return mixed
     */
    public function destroy(User $user, Ability $ability)
    {
        return $user->hasAbility('destroy', Ability::class);
    }
}
