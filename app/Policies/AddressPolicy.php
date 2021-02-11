<?php

namespace App\Policies\Api\v1;

use App\Models\{ Address, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any addresses.
     *
     * @param \App\Models\User $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Address::class);
    }

    /**
     * Determine whether the user can view the address.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Address $address
     * 
     * @return mixed
     */
    public function show(User $user, Address $address)
    {
        if ($address->owner) {
            if ($user->id === $address->owner->id) {
                return true;
            } else if ($user->can('show', $address->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('show', Address::class);
    }

    /**
     * Determine whether the user can create addresses.
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
        if ($address->owner) {
            if ($user->id === $address->owner->id) {
                return true;
            } else if ($user->can('update', $address->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('update', Address::class);
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
        if ($address->owner) {
            if ($user->id === $address->owner->id) {
                return true;
            } else if ($user->can('destroy', $address->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('destroy', Address::class);
    }
}
