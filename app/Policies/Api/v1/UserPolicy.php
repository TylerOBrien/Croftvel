<?php

namespace App\Policies\Api\v1;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return in_array($user->type, config('croft.privileges.admin'));
    }

    /**
     * Determine whether the user can view the model.
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

        return in_array($user->type, config('croft.privileges.admin'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return in_array($user->type, config('croft.privileges.admin'));
    }

    /**
     * Determine whether the user can update the model.
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
        
        return in_array($user->type, config('croft.privileges.admin'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * 
     * @return mixed
     */
    public function destroy(User $user, User $model)
    {
        return in_array($user->type, config('croft.privileges.admin'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * 
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        return in_array($user->type, config('croft.privileges.admin'));
    }
}
