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
     * @param \App\Models\User $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return in_array($user->type, config('croft.privileges.admin'));
    }

    /**
     * Determine whether the user can view the meta.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Meta $meta
     * 
     * @return mixed
     */
    public function show(User $user, Meta $meta)
    {
        if ($user->id === $meta->created_by) {
            return true;
        }

        $owner = call_user_func("{$meta->owner_type}::find", $meta->owner_id);

        if ($owner) {
            return $user->can('show', $owner);
        }
        
        return in_array($user->type, config('croft.privileges.admin'));
    }

    /**
     * Determine whether the user can create metas.
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
     * Determine whether the user can update the meta.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Meta $meta
     * 
     * @return mixed
     */
    public function update(User $user, Meta $meta)
    {
        if ($user->id === $meta->created_by) {
            return true;
        }

        $owner = call_user_func("{$meta->owner_type}::find", $meta->owner_id);

        if ($owner) {
            return $user->can('update', $owner);
        }
        
        return in_array($user->type, config('croft.privileges.admin'));
    }

    /**
     * Determine whether the user can delete the meta.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Meta $meta
     * 
     * @return mixed
     */
    public function destroy(User $user, Meta $meta)
    {
        if ($user->id === $meta->created_by) {
            return true;
        }

        $owner = call_user_func("{$meta->owner_type}::find", $meta->owner_id);

        if ($owner) {
            return $user->can('destroy', $owner);
        }
        
        return in_array($user->type, config('croft.privileges.admin'));
    }
}
