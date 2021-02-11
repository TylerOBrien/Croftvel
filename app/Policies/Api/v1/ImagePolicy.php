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
        return $user->hasAbility('store', Image::class);
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
        return $user->hasAbility('destroy', Image::class);
    }
}
