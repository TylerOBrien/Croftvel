<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileString\{ IndexProfileString, ShowProfileString, StoreProfileString, UpdateProfileString, DestroyProfileString };
use App\Models\{ Profile, ProfileString };

class ProfileStringController extends Controller
{
    /**
     * Display a listing of the profile string.
     * 
     * @param  Profile  $profile
     * @param  IndexProfileString  $request
     *
     * @return Response
     */
    public function index(Profile $profile, IndexProfileString $request)
    {
        return ProfileString::all();
    }

    /**
     * Display the specified profile string.
     * 
     * @param  Profile  $profile
     * @param  ProfileString  $string
     * @param  ShowProfileString  $request
     *
     * @return Response
     */
    public function show(Profile $profile, ProfileString $string, ShowProfileString $request)
    {
        return $string;
    }

    /**
     * Store a newly created profile string in storage.
     * 
     * @param  Profile  $profile
     * @param  StoreProfileString  $request
     *
     * @return Response
     */
    public function store(Profile $profile, StoreProfileString $request)
    {
        $fields = array_merge($request->validated(), [
            'profile_id' => $profile->id
        ]);

        return ProfileString::create($fields);
    }

    /**
     * Update the specified profile string in storage.
     * 
     * @param  Profile  $profile
     * @param  ProfileString  $string
     * @param  UpdateProfileString  $request
     * 
     * @return Response
     */
    public function update(Profile $profile, ProfileString $string, UpdateProfileString $request)
    {
        $fields = $request->validated();

        $string->fill($fields);
        $string->save();

        return $string->only(array_keys($fields));
    }

    /**
     * Remove the specified profile string from storage.
     * 
     * @param  Profile  $profile
     * @param  ProfileString  $string
     * @param  DestroyProfileString  $request
     *
     * @return Response
     */
    public function destroy(Profile $profile, ProfileString $string, DestroyProfileString $request)
    {
        $string->delete();
        return response()->json(null, 204);
    }
}
