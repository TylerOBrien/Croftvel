<?php

namespace App\Policies\Api\v1;

use App\Models\{ Image, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any imagePlural.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Image::class);
    }

    /**
     * Determine whether the user can view the image.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Image  $image
     *
     * @return mixed
     */
    public function show(User $user, Image $image)
    {
        if ($image->owner) {
            if ($user->id === $image->owner->id) {
                return true;
            } else if ($user->can('show', $image->owner)) {
                return true;
            }
        }

        return $user->hasAbility('show', Image::class);
    }

    /**
     * Determine whether the user can create imagePlural.
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
     * Determine whether the user can update the image.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Image  $image
     *
     * @return mixed
     */
    public function update(User $user, Image $image)
    {
        if ($image->owner) {
            if ($user->id === $image->owner->id) {
                return true;
            } else if ($user->can('update', $image->owner)) {
                return true;
            }
        }

        return $user->hasAbility('update', Image::class);
    }

    /**
     * Determine whether the user can delete the image.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Image  $image
     *
     * @return mixed
     */
    public function destroy(User $user, Image $image)
    {
        if ($image->owner) {
            if ($user->id === $image->owner->id) {
                return true;
            } else if ($user->can('destroy', $image->owner)) {
                return true;
            }
        }

        return $user->hasAbility('destroy', Image::class);
    }
}
