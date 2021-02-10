<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileString\{ IndexProfileString, ShowProfileString, StoreProfileString, UpdateProfileString, DestroyProfileString };
use App\Models\ProfileString;

class ProfileStringController extends Controller
{
    /**
     * Display a listing of the profile string.
     * 
     * @param  IndexProfileString  $request
     *
     * @return Response
     */
    public function index(IndexProfileString $request)
    {
        return ProfileString::all();
    }

    /**
     * Display the specified profile string.
     * 
     * @param  ProfileString  $profile_string
     * @param  ShowProfileString  $request
     *
     * @return Response
     */
    public function show(ProfileString $profile_string, ShowProfileString $request)
    {
        return $profile_string;
    }

    /**
     * Store a newly created profile string in storage.
     * 
     * @param  StoreProfileString  $request
     *
     * @return Response
     */
    public function store(StoreProfileString $request)
    {
        $fields = $request->validated();
        $profile_stringId = ProfileString::create($fields)->id;

        return ProfileString::find($profile_stringId);
    }

    /**
     * Update the specified profile string in storage.
     * 
     * @param  ProfileString  $profile_string
     * @param  UpdateProfileString  $request
     * 
     * @return Response
     */
    public function update(ProfileString $profile_string, UpdateProfileString $request)
    {
        $fields = $request->validated();

        $profile_string->fill($fields);
        $profile_string->save();

        return $profile_string->only(array_keys($fields));
    }

    /**
     * Remove the specified profile string from storage.
     * 
     * @param  ProfileString  $profile_string
     * @param  DestroyProfileString  $request
     *
     * @return Response
     */
    public function destroy(ProfileString $profile_string, DestroyProfileString $request)
    {
        $profile_string->delete();
        return response()->json(null, 204);
    }
}
