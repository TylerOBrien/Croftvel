<?php

namespace App\Policies\Api\v1;

use App\Models\{ Account, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any accounts.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Account::class);
    }

    /**
     * Determine whether the user can view the account.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $account
     * 
     * @return mixed
     */
    public function show(User $user, Account $account)
    {
        return $user->hasAbility('show', Account::class);
    }

    /**
     * Determine whether the user can create accounts.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', Account::class);
    }

    /**
     * Determine whether the user can update the account.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $account
     * 
     * @return mixed
     */
    public function update(User $user, Account $account)
    {
        return $user->hasAbility('update', Account::class);
    }

    /**
     * Determine whether the user can attach resources to the account.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $account
     * 
     * @return mixed
     */
    public function attach(User $user, Account $account)
    {
        if ($user->account->id === $account->id) {
            return true;
        }

        return $user->hasAbility('attach', Account::class);
    }

    /**
     * Determine whether the user can delete the account.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $account
     * 
     * @return mixed
     */
    public function destroy(User $user, Account $account)
    {
        return $user->hasAbility('destroy', Account::class);
    }
}
