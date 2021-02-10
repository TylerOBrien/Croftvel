<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileStringEntry\{ IndexProfileStringEntry, ShowProfileStringEntry, StoreProfileStringEntry, UpdateProfileStringEntry, DestroyProfileStringEntry };
use App\Models\ProfileStringEntry;

class ProfileStringEntryController extends Controller
{
    /**
     * Display a listing of the profile_string_entry.
     * 
     * @param IndexProfileStringEntry $request
     *
     * @return Response
     */
    public function index(IndexProfileStringEntry $request)
    {
        return ProfileStringEntry::all();
    }

    /**
     * Display the specified profile_string_entry.
     * 
     * @param ProfileStringEntry $profile_string_entry
     * @param ShowProfileStringEntry $request
     *
     * @return Response
     */
    public function show(ProfileStringEntry $profile_string_entry, ShowProfileStringEntry $request)
    {
        return $profile_string_entry;
    }

    /**
     * Store a newly created profile_string_entry in storage.
     * 
     * @param StoreProfileStringEntry $request
     *
     * @return Response
     */
    public function store(StoreProfileStringEntry $request)
    {
        $fields = $request->validated();
        $profile_string_entryId = ProfileStringEntry::create($fields)->id;

        return ProfileStringEntry::find($profile_string_entryId);
    }

    /**
     * Update the specified profile_string_entry in storage.
     * 
     * @param ProfileStringEntry $profile_string_entry
     * @param UpdateProfileStringEntry $request
     * 
     * @return Response
     */
    public function update(ProfileStringEntry $profile_string_entry, UpdateProfileStringEntry $request)
    {
        $fields = $request->validated();

        $profile_string_entry->fill($fields);
        $profile_string_entry->save();

        return $profile_string_entry->only(array_keys($fields));
    }

    /**
     * Remove the specified profile_string_entry from storage.
     * 
     * @param ProfileStringEntry $profile_string_entry
     * @param DestroyProfileStringEntry $request
     *
     * @return Response
     */
    public function destroy(ProfileStringEntry $profile_string_entry, DestroyProfileStringEntry $request)
    {
        $profile_string_entry->delete();
        return response()->json(null, 204);
    }
}
