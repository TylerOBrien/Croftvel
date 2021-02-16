<?php

namespace App\Policies\Api\v1;

use App\Models\{ Secret, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class SecretPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any secrets.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Secret::class);
    }

    /**
     * Determine whether the user can view the secret.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Secret  $secret
     * 
     * @return mixed
     */
    public function show(User $user, Secret $secret)
    {
        return $user->hasAbility('show', Secret::class, $secret->id);
    }

    /**
     * Determine whether the user can create secrets.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
       return true;
    }

    /**
     * Determine whether the user can update the secret.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Secret  $secret
     * 
     * @return mixed
     */
    public function update(User $user, Secret $secret)
    {
        return $user->hasAbility('update', Secret::class, $secret->id);
    }

    /**
     * Determine whether the user can attach resources to the secret.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Secret  $secret
     * 
     * @return mixed
     */
    public function attach(User $user, Secret $secret)
    {
        return $user->hasAbility('attach', Secret::class, $secret->id);
    }

    /**
     * Determine whether the user can delete the secret.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Secret  $secret
     * 
     * @return mixed
     */
    public function destroy(User $user, Secret $secret)
    {
        return $user->hasAbility('destroy', Secret::class, $secret->id);
    }
}
