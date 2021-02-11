<?php

namespace App\Policies\Api\v1;

use App\Models\{ Verification, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class VerificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any verifications.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Verification::class);
    }

    /**
     * Determine whether the user can view the verification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Verification  $verification
     * 
     * @return mixed
     */
    public function show(User $user, Verification $verification)
    {
        return $user->hasAbility('show', Verification::class);
    }

    /**
     * Determine whether the user can create verifications.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', Verification::class);
    }

    /**
     * Determine whether the user can update the verification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Verification  $verification
     * 
     * @return mixed
     */
    public function update(User $user, Verification $verification)
    {
        return $user->hasAbility('update', Verification::class);
    }

    /**
     * Determine whether the user can delete the verification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Verification  $verification
     * 
     * @return mixed
     */
    public function destroy(User $user, Verification $verification)
    {
        return $user->hasAbility('destroy', Verification::class);
    }
}
