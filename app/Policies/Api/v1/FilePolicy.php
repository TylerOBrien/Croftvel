<?php

namespace App\Policies\Api\v1;

use App\Models\{ File, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any files.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', File::class);
    }

    /**
     * Determine whether the user can view the file.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * 
     * @return mixed
     */
    public function show(User $user, File $file)
    {
        if ($file->owner) {
            if ($user->id === $file->owner->id) {
                return true;
            } else if ($user->can('show', $file->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('show', File::class);
    }

    /**
     * Determine whether the user can create files.
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
     * Determine whether the user can update the file.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * 
     * @return mixed
     */
    public function update(User $user, File $file)
    {
        if ($file->owner) {
            if ($user->id === $file->owner->id) {
                return true;
            } else if ($user->can('update', $file->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('update', File::class);
    }

    /**
     * Determine whether the user can delete the file.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * 
     * @return mixed
     */
    public function destroy(User $user, File $file)
    {
        if ($file->owner) {
            if ($user->id === $file->owner->id) {
                return true;
            } else if ($user->can('destroy', $file->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('destroy', File::class);
    }
}
