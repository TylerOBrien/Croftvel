<?php

namespace App\Policies\Api\v1;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any users.
     *
     * @param \App\Models\User $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * 
     * @return mixed
     */
    public function show(User $user, User $model)
    {
        if ($user->id === $model->id) {
            return true;
        }

        return true;
    }

    /**
     * Determine whether the user can create users.
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
     * Determine whether the user can update the user.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * 
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if ($user->id === $model->id) {
            return true;
        }
        
        return true;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * 
     * @return mixed
     */
    public function destroy(User $user, User $model)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the user.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * 
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        return true;
    }
}
