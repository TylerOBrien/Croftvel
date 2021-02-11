<?php

namespace App\Policies\Api\v1;

use App\Models\{ Meta, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class MetaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any metas.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Meta::class);
    }

    /**
     * Determine whether the user can view the meta.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Meta  $meta
     * 
     * @return mixed
     */
    public function show(User $user, Meta $meta)
    {
        if ($meta->owner) {
            if ($user->id === $meta->owner->id) {
                return true;
            } else if ($user->can('show', $meta->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('show', Meta::class);
    }

    /**
     * Determine whether the user can create metas.
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
     * Determine whether the user can update the meta.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Meta  $meta
     * 
     * @return mixed
     */
    public function update(User $user, Meta $meta)
    {
        if ($meta->owner) {
            if ($user->id === $meta->owner->id) {
                return true;
            } else if ($user->can('update', $meta->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('update', Meta::class);
    }

    /**
     * Determine whether the user can delete the meta.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Meta  $meta
     * 
     * @return mixed
     */
    public function destroy(User $user, Meta $meta)
    {
        if ($meta->owner) {
            if ($user->id === $meta->owner->id) {
                return true;
            } else if ($user->can('destroy', $meta->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('destroy', Meta::class);
    }
}
