<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileFloat\{ IndexProfileFloat, ShowProfileFloat, StoreProfileFloat, UpdateProfileFloat, DestroyProfileFloat };
use App\Models\{ Profile, ProfileFloat };

class ProfileFloatController extends Controller
{
    /**
     * Display a listing of the profile float.
     * 
     * @param  IndexProfileFloat  $request
     *
     * @return Response
     */
    public function index(IndexProfileFloat $request)
    {
        return ProfileFloat::all();
    }

    /**
     * Display the specified profile float.
     * 
     * @param  ProfileFloat  $profile_float
     * @param  ShowProfileFloat  $request
     *
     * @return Response
     */
    public function show(ProfileFloat $profile_float, ShowProfileFloat $request)
    {
        return $profile_float;
    }

    /**
     * Store a newly created profile float in storage.
     * 
     * @param  Profile  $profile
     * @param  StoreProfileFloat  $request
     *
     * @return Response
     */
    public function store(Profile $profile, StoreProfileFloat $request)
    {
        $fields = array_merge($request->validated(), [
            'profile_id' => $profile->id
        ]);

        return ProfileFloat::create($fields)->fresh();
    }

    /**
     * Update the specified profile float in storage.
     * 
     * @param  Profile  $profile
     * @param  ProfileFloat  $profile_float
     * @param  UpdateProfileFloat  $request
     * 
     * @return Response
     */
    public function update(Profile $profile, ProfileFloat $profile_float, UpdateProfileFloat $request)
    {
        $fields = $request->validated();

        $profile_float->fill($fields);
        $profile_float->save();

        return $profile_float->only(array_keys($fields));
    }

    /**
     * Remove the specified profile float from storage.
     * 
     * @param  ProfileFloat  $profile_float
     * @param  DestroyProfileFloat  $request
     *
     * @return Response
     */
    public function destroy(ProfileFloat $profile_float, DestroyProfileFloat $request)
    {
        $profile_float->delete();
        return response()->json(null, 204);
    }
}
