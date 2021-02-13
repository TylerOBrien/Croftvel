<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Profile\{ IndexProfile, ShowProfile, StoreProfile, StoreProfileEntries, UpdateProfile, DestroyProfile };
use App\Models\Profile;

use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing of the profile.
     * 
     * @param  \App\Http\Requests\Api\v1\Profile\IndexProfile  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexProfile $request)
    {
        return Profile::all();
    }

    /**
     * Display the specified profile.
     * 
     * @param  \App\Models\Profile  $profile
     * @param  \App\Http\Requests\Api\v1\Profile\ShowProfile  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile, ShowProfile $request)
    {
        return $profile;
    }

    /**
     * Display a listing of the specified profile's entries.
     * 
     * @param  \App\Models\Profile  $profile
     * @param  \App\Http\Requests\Api\v1\Profile\ShowProfile  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function indexEntries(Profile $profile, ShowProfile $request)
    {
        return $profile->entries;
    }

    /**
     * Store new entries for the profile in storage.
     * 
     * @param  \App\Models\Profile  $profile
     * @param  \App\Http\Requests\Api\v1\Profile\ShowProfile  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function storeEntries(Profile $profile, StoreProfileEntries $request)
    {
        $created = collect();

        foreach ($request->validated()['entries'] as $entry) {
            $model = 'App\Models\Profile' . Str::ucfirst($entry['type']);
            $attributes = array_merge($entry, [
                'profile_id' => $profile->id
            ]);

            $created->push($model::create($attributes));
        }

        return $created;
    }

    /**
     * Store a newly created profile in storage.
     * 
     * @param  \App\Http\Requests\Api\v1\Profile\StoreProfile  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfile $request)
    {
        $fields = $request->validated();

        return Profile::create($fields);
    }

    /**
     * Update the specified profile in storage.
     * 
     * @param  \App\Models\Profile  $profile
     * @param  \App\Http\Requests\Api\v1\Profile\UpdateProfile  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Profile $profile, UpdateProfile $request)
    {
        $fields = $request->validated();

        $profile->fill($fields);
        $profile->save();

        return $profile->only(array_keys($fields));
    }

    /**
     * Remove the specified profile from storage.
     * 
     * @param  \App\Models\Profile  $profile
     * @param  \App\Http\Requests\Api\v1\Profile\DestroyProfile  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile, DestroyProfile $request)
    {
        $profile->delete();
        return response()->json(null, 204);
    }
}
