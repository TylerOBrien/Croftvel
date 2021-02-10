<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileFloatEntry\{ IndexProfileFloatEntry, ShowProfileFloatEntry, StoreProfileFloatEntry, UpdateProfileFloatEntry, DestroyProfileFloatEntry };
use App\Models\ProfileFloatEntry;

class ProfileFloatEntryController extends Controller
{
    /**
     * Display a listing of the profile_float_entry.
     * 
     * @param IndexProfileFloatEntry $request
     *
     * @return Response
     */
    public function index(IndexProfileFloatEntry $request)
    {
        return ProfileFloatEntry::all();
    }

    /**
     * Display the specified profile_float_entry.
     * 
     * @param ProfileFloatEntry $profile_float_entry
     * @param ShowProfileFloatEntry $request
     *
     * @return Response
     */
    public function show(ProfileFloatEntry $profile_float_entry, ShowProfileFloatEntry $request)
    {
        return $profile_float_entry;
    }

    /**
     * Store a newly created profile_float_entry in storage.
     * 
     * @param StoreProfileFloatEntry $request
     *
     * @return Response
     */
    public function store(StoreProfileFloatEntry $request)
    {
        $fields = $request->validated();
        $profile_float_entryId = ProfileFloatEntry::create($fields)->id;

        return ProfileFloatEntry::find($profile_float_entryId);
    }

    /**
     * Update the specified profile_float_entry in storage.
     * 
     * @param ProfileFloatEntry $profile_float_entry
     * @param UpdateProfileFloatEntry $request
     * 
     * @return Response
     */
    public function update(ProfileFloatEntry $profile_float_entry, UpdateProfileFloatEntry $request)
    {
        $fields = $request->validated();

        $profile_float_entry->fill($fields);
        $profile_float_entry->save();

        return $profile_float_entry->only(array_keys($fields));
    }

    /**
     * Remove the specified profile_float_entry from storage.
     * 
     * @param ProfileFloatEntry $profile_float_entry
     * @param DestroyProfileFloatEntry $request
     *
     * @return Response
     */
    public function destroy(ProfileFloatEntry $profile_float_entry, DestroyProfileFloatEntry $request)
    {
        $profile_float_entry->delete();
        return response()->json(null, 204);
    }
}
