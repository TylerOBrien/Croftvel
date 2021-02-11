<?php

namespace App\Policies\Api\v1;

use App\Models\{ Video, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any videos.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Video::class);
    }

    /**
     * Determine whether the user can view the video.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Video  $video
     * 
     * @return mixed
     */
    public function show(User $user, Video $video)
    {
        if ($video->owner) {
            if ($user->id === $video->owner->id) {
                return true;
            } else if ($user->can('show', $video->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('show', Video::class);
    }

    /**
     * Determine whether the user can create videos.
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
     * Determine whether the user can update the video.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Video  $video
     * 
     * @return mixed
     */
    public function update(User $user, Video $video)
    {
        if ($video->owner) {
            if ($user->id === $video->owner->id) {
                return true;
            } else if ($user->can('update', $video->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('update', Video::class);
    }

    /**
     * Determine whether the user can delete the video.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Video  $video
     * 
     * @return mixed
     */
    public function destroy(User $user, Video $video)
    {
        if ($video->owner) {
            if ($user->id === $video->owner->id) {
                return true;
            } else if ($user->can('destroy', $video->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('destroy', Video::class);
    }
}
