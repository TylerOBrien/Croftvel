<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Traits\Controllers\Api\v1\{ HasPasswordReset, HasQueryFilter };
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\User\{ IndexUser, StoreUser, ShowUser, UpdateUser, RestoreUser, DestroyUser, VerifyUserEmail };

class UserController extends Controller
{
    use HasPasswordReset, HasQueryFilter;
    
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
        $users = User::where('is_active', 1);

        return $this->filtered($users, $fields)
                    ->with(config('croft.relationships.user.index'))
                    ->get()
                    ->each->append(config('croft.attributes.user.index'));
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
        return $user->load(config('croft.relationships.user.show'))
                    ->append(config('croft.attributes.user.show'));
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
        $user_id = User::create($fields)->id;

        return User::find($user_id)
                   ->load(config('croft.relationships.user.store'))
                   ->append(config('croft.attributes.user.store'));
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

        return $user->only(array_keys($fields));
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
        $user->activate();
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
        $user->deactivate();
        return response()->json(null, 204);
    }
}
