<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileIntegerEntry\{ IndexProfileIntegerEntry, ShowProfileIntegerEntry, StoreProfileIntegerEntry, UpdateProfileIntegerEntry, DestroyProfileIntegerEntry };
use App\Models\ProfileIntegerEntry;

class ProfileIntegerEntryController extends Controller
{
    /**
     * Display a listing of the profile_integer_entry.
     * 
     * @param IndexProfileIntegerEntry $request
     *
     * @return Response
     */
    public function index(IndexProfileIntegerEntry $request)
    {
        return ProfileIntegerEntry::all();
    }

    /**
     * Display the specified profile_integer_entry.
     * 
     * @param ProfileIntegerEntry $profile_integer_entry
     * @param ShowProfileIntegerEntry $request
     *
     * @return Response
     */
    public function show(ProfileIntegerEntry $profile_integer_entry, ShowProfileIntegerEntry $request)
    {
        return $profile_integer_entry;
    }

    /**
     * Store a newly created profile_integer_entry in storage.
     * 
     * @param StoreProfileIntegerEntry $request
     *
     * @return Response
     */
    public function store(StoreProfileIntegerEntry $request)
    {
        $fields = $request->validated();
        $profile_integer_entryId = ProfileIntegerEntry::create($fields)->id;

        return ProfileIntegerEntry::find($profile_integer_entryId);
    }

    /**
     * Update the specified profile_integer_entry in storage.
     * 
     * @param ProfileIntegerEntry $profile_integer_entry
     * @param UpdateProfileIntegerEntry $request
     * 
     * @return Response
     */
    public function update(ProfileIntegerEntry $profile_integer_entry, UpdateProfileIntegerEntry $request)
    {
        $fields = $request->validated();

        $profile_integer_entry->fill($fields);
        $profile_integer_entry->save();

        return $profile_integer_entry->only(array_keys($fields));
    }

    /**
     * Remove the specified profile_integer_entry from storage.
     * 
     * @param ProfileIntegerEntry $profile_integer_entry
     * @param DestroyProfileIntegerEntry $request
     *
     * @return Response
     */
    public function destroy(ProfileIntegerEntry $profile_integer_entry, DestroyProfileIntegerEntry $request)
    {
        $profile_integer_entry->delete();
        return response()->json(null, 204);
    }
}
