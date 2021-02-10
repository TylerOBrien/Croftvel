<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileInteger\{ IndexProfileInteger, ShowProfileInteger, StoreProfileInteger, UpdateProfileInteger, DestroyProfileInteger };
use App\Models\ProfileInteger;

class ProfileIntegerController extends Controller
{
    /**
     * Display a listing of the profile integer.
     * 
     * @param  IndexProfileInteger  $request
     *
     * @return Response
     */
    public function index(IndexProfileInteger $request)
    {
        return ProfileInteger::all();
    }

    /**
     * Display the specified profile integer.
     * 
     * @param  ProfileInteger  $profile_integer
     * @param  ShowProfileInteger  $request
     *
     * @return Response
     */
    public function show(ProfileInteger $profile_integer, ShowProfileInteger $request)
    {
        return $profile_integer;
    }

    /**
     * Store a newly created profile integer in storage.
     * 
     * @param  StoreProfileInteger  $request
     *
     * @return Response
     */
    public function store(StoreProfileInteger $request)
    {
        $fields = $request->validated();
        $profile_integerId = ProfileInteger::create($fields)->id;

        return ProfileInteger::find($profile_integerId);
    }

    /**
     * Update the specified profile integer in storage.
     * 
     * @param  ProfileInteger  $profile_integer
     * @param  UpdateProfileInteger  $request
     * 
     * @return Response
     */
    public function update(ProfileInteger $profile_integer, UpdateProfileInteger $request)
    {
        $fields = $request->validated();

        $profile_integer->fill($fields);
        $profile_integer->save();

        return $profile_integer->only(array_keys($fields));
    }

    /**
     * Remove the specified profile integer from storage.
     * 
     * @param  ProfileInteger  $profile_integer
     * @param  DestroyProfileInteger  $request
     *
     * @return Response
     */
    public function destroy(ProfileInteger $profile_integer, DestroyProfileInteger $request)
    {
        $profile_integer->delete();
        return response()->json(null, 204);
    }
}
