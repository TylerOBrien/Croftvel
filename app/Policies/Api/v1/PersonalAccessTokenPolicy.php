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
        return $user->hasAbility('index', PersonalAccessToken::class);
    }

    /**
     * Determine whether the user can view the token.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PersonalAccessToken $model
     * 
     * @return mixed
     */
    public function show(User $user, PersonalAccessToken $model)
    {
        if ($user->id === $model->tokenable_id && $model->tokenable_type === User::class) {
            return true;
        }

        return $user->hasAbility('show', PersonalAccessToken::class);
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
     * Determine whether the user can update the token.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PersonalAccessToken $model
     * 
     * @return mixed
     */
    public function update(User $user, PersonalAccessToken $model)
    {
        return $user->hasAbility('update', PersonalAccessToken::class);
    }

    /**
     * Determine whether the user can delete the token.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PersonalAccessToken $model
     * 
     * @return mixed
     */
    public function destroy(User $user, PersonalAccessToken $model)
    {
        if ($user->id === $model->tokenable_id && $model->tokenable_type === User::class) {
            return true;
        }
        
        return $user->hasAbility('destroy', PersonalAccessToken::class);
    }
}
