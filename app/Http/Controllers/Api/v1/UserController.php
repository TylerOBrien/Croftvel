<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\User\{ IndexUser, StoreUser, ShowUser, UpdateUser, RestoreUser, DestroyUser };
use App\Http\Resources\Api\v1\TokenResource;
use App\Models\{ Account, User };
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class UserController extends Controller
{
    use HasControllerHelpers;
    
    /**
     * Display a listing of the users.
     * 
     * @param IndexUser $request
     *
     * @return Response
     */
    public function index(IndexUser $request)
    {
        $fields = $request->validated();
        $users = User::select();

        return $this->filtered($users, $fields);
    }

    /**
     * Display the specified user.
     * 
     * @param User $user
     * @param ShowUser $request
     *
     * @return Response
     */
    public function show(User $user, ShowUser $request)
    {
        return $user;
    }

    /**
     * Store a newly created user in storage.
     * 
     * @param StoreUser $request
     *
     * @return Response
     */
    public function store(StoreUser $request)
    {
        $fields = $request->validated();

        if (array_key_exists('account_id', $fields)) {
            $account_id = intval($fields['account_id']);
        } else {
            $account_id = auth('croft')->parseToken($request)->account->id ?? Account::create()->id;
        }

        $user = User::create(array_merge(compact('account_id'), $fields));
        $pat = $user->createToken(config('croft.token.name'));
        $token = new TokenResource($pat);

        return compact('token', 'user');
    }

    /**
     * Update the specified user in storage.
     * 
     * @param User $user
     * @param UpdateUser $request
     * 
     * @return Response
     */
    public function update(User $user, UpdateUser $request)
    {
        $fields = $request->validated();

        $user->fill($fields);
        $user->save();

        return $user;
    }

    /**
     * Restore the specified user in storage.
     * 
     * @param User $user
     * @param RestoreUser $request
     *
     * @return Response
     */
    public function restore(User $user, RestoreUser $request)
    {
        $user->enable();
        return response()->json(null, 204);
    }

    /**
     * Remove the specified user from storage.
     * 
     * @param User $user
     * @param DestroyUser $request
     *
     * @return Response
     */
    public function destroy(User $user, DestroyUser $request)
    {
        $user->disable();
        return response()->json(null, 204);
    }
}
