<?php

namespace App\Policies\Api\v1;

use App\Models\{ Address, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
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
     * @param \App\Models\User    $user
     * @param \App\Models\Address $address
     * 
     * @return mixed
     */
    public function show(User $user, Address $address)
    {
        if ($user->id === $address->created_by) {
            return true;
        }

        $owner = call_user_func("{$address->owner_type}::find", $address->owner_id);

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
     * Determine whether the user can update the address.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Address $address
     * 
     * @return mixed
     */
    public function update(User $user, Address $address)
    {
        if ($user->id === $address->created_by) {
            return true;
        }

        $owner = call_user_func("{$address->owner_type}::find", $address->owner_id);

        if ($owner) {
            return $user->can('update', $owner);
        }
        
        return in_array($user->type, config('croft.privileges.admin'));
    }

    /**
     * Determine whether the user can delete the address.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Address $address
     * 
     * @return mixed
     */
    public function destroy(User $user, Address $address)
    {
        if ($user->id === $address->created_by) {
            return true;
        }

        $owner = call_user_func("{$address->owner_type}::find", $address->owner_id);

        if ($owner) {
            return $user->can('destroy', $owner);
        }
        
        return in_array($user->type, config('croft.privileges.admin'));
    }
}
