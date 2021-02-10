<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileTextEntry\{ IndexProfileTextEntry, ShowProfileTextEntry, StoreProfileTextEntry, UpdateProfileTextEntry, DestroyProfileTextEntry };
use App\Models\ProfileTextEntry;

class ProfileTextEntryController extends Controller
{
    /**
     * Display a listing of the profile_text_entry.
     * 
     * @param IndexProfileTextEntry $request
     *
     * @return Response
     */
    public function index(IndexProfileTextEntry $request)
    {
        return ProfileTextEntry::all();
    }

    /**
     * Display the specified profile_text_entry.
     * 
     * @param ProfileTextEntry $profile_text_entry
     * @param ShowProfileTextEntry $request
     *
     * @return Response
     */
    public function show(ProfileTextEntry $profile_text_entry, ShowProfileTextEntry $request)
    {
        return $profile_text_entry;
    }

    /**
     * Store a newly created profile_text_entry in storage.
     * 
     * @param StoreProfileTextEntry $request
     *
     * @return Response
     */
    public function store(StoreProfileTextEntry $request)
    {
        $fields = $request->validated();
        $profile_text_entryId = ProfileTextEntry::create($fields)->id;

        return ProfileTextEntry::find($profile_text_entryId);
    }

    /**
     * Update the specified profile_text_entry in storage.
     * 
     * @param ProfileTextEntry $profile_text_entry
     * @param UpdateProfileTextEntry $request
     * 
     * @return Response
     */
    public function update(ProfileTextEntry $profile_text_entry, UpdateProfileTextEntry $request)
    {
        $fields = $request->validated();

        $profile_text_entry->fill($fields);
        $profile_text_entry->save();

        return $profile_text_entry->only(array_keys($fields));
    }

    /**
     * Remove the specified profile_text_entry from storage.
     * 
     * @param ProfileTextEntry $profile_text_entry
     * @param DestroyProfileTextEntry $request
     *
     * @return Response
     */
    public function destroy(ProfileTextEntry $profile_text_entry, DestroyProfileTextEntry $request)
    {
        $profile_text_entry->delete();
        return response()->json(null, 204);
    }
}
