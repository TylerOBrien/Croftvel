<?php

namespace App\Policies\Api\v1;

use App\Models\{ Profile, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any profiles.
     *
     * @param \App\Models\User $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Profile::class);
    }

    /**
     * Determine whether the user can view the profile.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Profile $profile
     * 
     * @return mixed
     */
    public function show(User $user, Profile $profile)
    {
        if ($profile->owner) {
            if ($user->id === $profile->owner->id) {
                return true;
            } else if ($user->can('show', $profile->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('show', Profile::class);
    }

    /**
     * Determine whether the user can create profiles.
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
     * Determine whether the user can update the profile.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Profile $profile
     * 
     * @return mixed
     */
    public function update(User $user, Profile $profile)
    {
        if ($profile->owner) {
            if ($user->id === $profile->owner->id) {
                return true;
            } else if ($user->can('update', $profile->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('update', Profile::class);
    }

    /**
     * Determine whether the user can delete the profile.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Profile $profile
     * 
     * @return mixed
     */
    public function destroy(User $user, Profile $profile)
    {
        if ($profile->owner) {
            if ($user->id === $profile->owner->id) {
                return true;
            } else if ($user->can('destroy', $profile->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('destroy', Profile::class);
    }
}
