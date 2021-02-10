<?php

namespace App\Policies\Api\v1;

use App\Models\{ PersonalAccessToken, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class PersonalAccessTokenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tokens.
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
     * Determine whether the user can view the identity.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PersonalAccessToken $model
     * 
     * @return mixed
     */
    public function show(User $user, PersonalAccessToken $model)
    {
        return true;
    }

    /**
     * Determine whether the user can create tokens.
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
     * @param \App\Models\PersonalAccessToken $model
     * 
     * @return mixed
     */
    public function update(User $user, PersonalAccessToken $model)
    {
        return true;
    }

    /**
     * Determine whether the user can verify the identity.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PersonalAccessToken $model
     * 
     * @return mixed
     */
    public function verify(User $user, PersonalAccessToken $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the identity.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PersonalAccessToken $model
     * 
     * @return mixed
     */
    public function destroy(User $user, PersonalAccessToken $model)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the identity.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PersonalAccessToken $model
     * 
     * @return mixed
     */
    public function restore(User $user, PersonalAccessToken $model)
    {
        return true;
    }
}
