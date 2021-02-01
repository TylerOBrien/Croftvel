<?php

namespace App\Policies\Api\v1;

use App\Models\{ Image, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any images.
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
     * Determine whether the user can view the image.
     *
     * @param \App\Models\User  $user
     * @param \App\Models\Image $image
     * 
     * @return mixed
     */
    public function show(User $user, Image $image)
    {
        if ($user->id === $image->created_by) {
            return true;
        }

        $owner = call_user_func("{$image->owner_type}::find", $image->owner_id);

        if ($owner) {
            return $user->can('show', $owner);
        }
        
        return in_array($user->type, config('croft.privileges.admin'));
    }

    /**
     * Determine whether the user can create images.
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
     * Determine whether the user can update the image.
     *
     * @param \App\Models\User  $user
     * @param \App\Models\Image $image
     * 
     * @return mixed
     */
    public function update(User $user, Image $image)
    {
        if ($user->id === $image->created_by) {
            return true;
        }

        $owner = call_user_func("{$image->owner_type}::find", $image->owner_id);

        if ($owner) {
            return $user->can('update', $owner);
        }
        
        return in_array($user->type, config('croft.privileges.admin'));
    }

    /**
     * Determine whether the user can delete the image.
     *
     * @param \App\Models\User  $user
     * @param \App\Models\Image $image
     * 
     * @return mixed
     */
    public function destroy(User $user, Image $image)
    {
        if ($user->id === $image->created_by) {
            return true;
        }

        $owner = call_user_func("{$image->owner_type}::find", $image->owner_id);

        if ($owner) {
            return $user->can('destroy', $owner);
        }
        
        return in_array($user->type, config('croft.privileges.admin'));
    }
}
