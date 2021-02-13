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
     * @param  ProfileText  $text
     * @param  ShowProfileText  $request
     *
     * @return Response
     */
    public function show(Profile $profile, ProfileText $text, ShowProfileText $request)
    {
        return $text;
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

        return ProfileText::create($fields);
    }

    /**
     * Update the specified profile text in storage.
     * 
     * @param  Profile  $profile
     * @param  ProfileText  $text
     * @param  UpdateProfileText  $request
     * 
     * @return Response
     */
    public function update(Profile $profile, ProfileText $text, UpdateProfileText $request)
    {
        $fields = $request->validated();

        $text->fill($fields);
        $text->save();

        return $text->only(array_keys($fields));
    }

    /**
     * Remove the specified profile text from storage.
     * 
     * @param  Profile  $profile
     * @param  ProfileText  $text
     * @param  DestroyProfileText  $request
     *
     * @return Response
     */
    public function destroy(Profile $profile, ProfileText $text, DestroyProfileText $request)
    {
        $text->delete();
        return response()->json(null, 204);
    }
}
