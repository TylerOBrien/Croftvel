<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileText\{ IndexProfileText, ShowProfileText, StoreProfileText, UpdateProfileText, DestroyProfileText };
use App\Models\ProfileText;

class ProfileTextController extends Controller
{
    /**
     * Display a listing of the profile text.
     * 
     * @param  IndexProfileText  $request
     *
     * @return Response
     */
    public function index(IndexProfileText $request)
    {
        return ProfileText::all();
    }

    /**
     * Display the specified profile text.
     * 
     * @param  ProfileText  $profile_text
     * @param  ShowProfileText  $request
     *
     * @return Response
     */
    public function show(ProfileText $profile_text, ShowProfileText $request)
    {
        return $profile_text;
    }

    /**
     * Store a newly created profile text in storage.
     * 
     * @param  StoreProfileText  $request
     *
     * @return Response
     */
    public function store(StoreProfileText $request)
    {
        $fields = $request->validated();
        $profile_textId = ProfileText::create($fields)->id;

        return ProfileText::find($profile_textId);
    }

    /**
     * Update the specified profile text in storage.
     * 
     * @param  ProfileText  $profile_text
     * @param  UpdateProfileText  $request
     * 
     * @return Response
     */
    public function update(ProfileText $profile_text, UpdateProfileText $request)
    {
        $fields = $request->validated();

        $profile_text->fill($fields);
        $profile_text->save();

        return $profile_text->only(array_keys($fields));
    }

    /**
     * Remove the specified profile text from storage.
     * 
     * @param  ProfileText  $profile_text
     * @param  DestroyProfileText  $request
     *
     * @return Response
     */
    public function destroy(ProfileText $profile_text, DestroyProfileText $request)
    {
        $profile_text->delete();
        return response()->json(null, 204);
    }
}
