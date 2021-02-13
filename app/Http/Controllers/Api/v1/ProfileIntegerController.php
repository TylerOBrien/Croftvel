<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileInteger\{ IndexProfileInteger, ShowProfileInteger, StoreProfileInteger, UpdateProfileInteger, DestroyProfileInteger };
use App\Models\{ Profile, ProfileInteger };

class ProfileIntegerController extends Controller
{
    /**
     * Display a listing of the profile integer.
     * 
     * @param  Profile  $profile
     * @param  IndexProfileInteger  $request
     *
     * @return Response
     */
    public function index(Profile $profile, IndexProfileInteger $request)
    {
        return ProfileInteger::all();
    }

    /**
     * Display the specified profile integer.
     * 
     * @param  Profile  $profile
     * @param  ProfileInteger  $integer
     * @param  ShowProfileInteger  $request
     *
     * @return Response
     */
    public function show(Profile $profile, ProfileInteger $integer, ShowProfileInteger $request)
    {
        return $integer;
    }

    /**
     * Store a newly created profile integer in storage.
     * 
     * @param  Profile  $profile
     * @param  StoreProfileInteger  $request
     *
     * @return Response
     */
    public function store(Profile $profile, StoreProfileInteger $request)
    {
        $fields = array_merge($request->validated(), [
            'profile_id' => $profile->id
        ]);

        return ProfileInteger::create($fields);
    }

    /**
     * Update the specified profile integer in storage.
     * 
     * @param  Profile  $profile
     * @param  ProfileInteger  $integer
     * @param  UpdateProfileInteger  $request
     * 
     * @return Response
     */
    public function update(Profile $profile, ProfileInteger $integer, UpdateProfileInteger $request)
    {
        $fields = $request->validated();

        $integer->fill($fields);
        $integer->save();

        return $integer->only(array_keys($fields));
    }

    /**
     * Remove the specified profile integer from storage.
     * 
     * @param  Profile  $profile
     * @param  ProfileInteger  $integer
     * @param  DestroyProfileInteger  $request
     *
     * @return Response
     */
    public function destroy(Profile $profile, ProfileInteger $integer, DestroyProfileInteger $request)
    {
        $integer->delete();
        return response()->json(null, 204);
    }
}
