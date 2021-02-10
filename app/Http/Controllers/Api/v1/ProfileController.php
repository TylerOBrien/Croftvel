<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Profile\{ IndexProfile, ShowProfile, StoreProfile, UpdateProfile, DestroyProfile };
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the profile.
     * 
     * @param IndexProfile $request
     *
     * @return Response
     */
    public function index(IndexProfile $request)
    {
        return Profile::all();
    }

    /**
     * Display the specified profile.
     * 
     * @param Profile $profile
     * @param ShowProfile $request
     *
     * @return Response
     */
    public function show(Profile $profile, ShowProfile $request)
    {
        return $profile;
    }

    /**
     * Store a newly created profile in storage.
     * 
     * @param StoreProfile $request
     *
     * @return Response
     */
    public function store(StoreProfile $request)
    {
        $fields = $request->validated();
        $profileId = Profile::create($fields)->id;

        return Profile::find($profileId);
    }

    /**
     * Update the specified profile in storage.
     * 
     * @param Profile $profile
     * @param UpdateProfile $request
     * 
     * @return Response
     */
    public function update(Profile $profile, UpdateProfile $request)
    {
        $fields = $request->validated();

        $profile->fill($fields);
        $profile->save();

        return $profile->only(array_keys($fields));
    }

    /**
     * Remove the specified profile from storage.
     * 
     * @param Profile $profile
     * @param DestroyProfile $request
     *
     * @return Response
     */
    public function destroy(Profile $profile, DestroyProfile $request)
    {
        $profile->delete();
        return response()->json(null, 204);
    }
}
