<?php

namespace App\Policies\Api\v1;

use App\Models\{ Identity, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class IdentityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any identities.
     *
     * @param \App\Models\User $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Identity::class);
    }

    /**
     * Determine whether the user can view the identity.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Identity $model
     * 
     * @return mixed
     */
    public function show(User $user, Identity $model)
    {
        if ($user->id === $model->user_id) {
            return true;
        }

        return $user->hasAbility('show', Identity::class);
    }

    /**
     * Determine whether the user can create identitys.
     *
     * @param \App\Models\User $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the identity.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Identity $model
     * 
     * @return mixed
     */
    public function update(User $user, Identity $model)
    {
        return $user->hasAbility('update', Identity::class);
    }

    /**
     * Determine whether the user can verify the identity.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Identity $model
     * 
     * @return mixed
     */
    public function verify(User $user, Identity $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the identity.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Identity $model
     * 
     * @return mixed
     */
    public function destroy(User $user, Identity $model)
    {
        if ($user->id === $model->user_id) {
            return true;
        }

        return $user->hasAbility('destroy', Identity::class);
    }

    /**
     * Determine whether the user can restore the identity.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Identity $model
     * 
     * @return mixed
     */
    public function restore(User $user, Identity $model)
    {
        return $user->hasAbility('restore', Identity::class);
    }
}
