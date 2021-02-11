<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileText\{ IndexProfileText, ShowProfileText, StoreProfileText, UpdateProfileText, DestroyProfileText };
use App\Models\{ Profile, ProfileText };

class ProfileTextController extends Controller
{
    /**
     * Display a listing of the profile text.
     * 
     * @param  Profile  $profile
     * @param  IndexProfileText  $request
     *
     * @return Response
     */
    public function index(Profile $profile, IndexProfileText $request)
    {
        return ProfileText::all();
    }

    /**
     * Display the specified profile text.
     * 
     * @param  Profile  $profile
     * @param  ProfileText  $profile_text
     * @param  ShowProfileText  $request
     *
     * @return Response
     */
    public function show(Profile $profile, ProfileText $profile_text, ShowProfileText $request)
    {
        return $profile_text;
    }

    /**
     * Store a newly created profile text in storage.
     * 
     * @param  Profile  $profile
     * @param  StoreProfileText  $request
     *
     * @return Response
     */
    public function store(Profile $profile, StoreProfileText $request)
    {
        $fields = array_merge($request->validated(), [
            'profile_id' => $profile->id
        ]);

        return ProfileText::create($fields)->fresh();
    }

    /**
     * Update the specified profile text in storage.
     * 
     * @param  Profile  $profile
     * @param  ProfileText  $profile_text
     * @param  UpdateProfileText  $request
     * 
     * @return Response
     */
    public function update(Profile $profile, ProfileText $profile_text, UpdateProfileText $request)
    {
        $fields = $request->validated();

        $profile_text->fill($fields);
        $profile_text->save();

        return $profile_text->only(array_keys($fields));
    }

    /**
     * Remove the specified profile text from storage.
     * 
     * @param  Profile  $profile
     * @param  ProfileText  $profile_text
     * @param  DestroyProfileText  $request
     *
     * @return Response
     */
    public function destroy(Profile $profile, ProfileText $profile_text, DestroyProfileText $request)
    {
        $profile_text->delete();
        return response()->json(null, 204);
    }
}
