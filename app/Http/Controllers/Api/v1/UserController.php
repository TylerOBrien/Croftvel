<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\User\{ IndexUser, ShowUser, StoreUser, UpdateUser, DestroyUser };
use App\Models\User;
use App\Traits\Controllers\Api\v1\HasQueryFilter;

class UserController extends Controller
{
    use HasQueryFilter;

    /**
     * Display a listing of the users.
     *
     * @param  \App\Http\Requests\Api\v1\User\IndexUser  $request
     *
     * @return  \Illuminate\Http\Response
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
     * @param  \App\Models\User  $user
     * @param  \App\Http\Requests\Api\v1\User\ShowUser  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, ShowUser $request)
    {
        return $user;
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \App\Http\Requests\Api\v1\User\StoreUser  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $fields = $request->validated();

        return User::create($fields);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Http\Requests\Api\v1\User\UpdateUser  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUser $request)
    {
        $fields = $request->validated();

        $user->fill($fields);
        $user->save();

        return $user;
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Http\Requests\Api\v1\User\DestroyUser  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, DestroyUser $request)
    {
        $user->delete();
        return response(null, 204);
    }
}
