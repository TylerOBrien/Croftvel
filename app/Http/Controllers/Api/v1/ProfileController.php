<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Profile\{ IndexProfile, ShowProfile, StoreProfile, UpdateProfile, DestroyProfile };
use App\Models\Profile;
use App\Traits\Controllers\Api\v1\HasQueryFilter;

class ProfileController extends Controller
{
    use HasQueryFilter;

    /**
     * Display a listing of the profiles.
     *
     * @param  \App\Http\Requests\Api\v1\Profile\IndexProfile  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexProfile $request)
    {
        $fields = $request->validated();
        $profiles = Profile::select();

        return $this->filtered($profiles, $fields);
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
     * Store a newly created profile in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Profile\StoreProfile  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfile $request)
    {
        $fields = $request->validated();
        $profile = Profile::create(array_merge($fields, [
            'owner_id' => auth()->id(),
            'owner_type' => 'App\Models\User',
        ]));

        if (isset($fields['fields'])) {
            $profile->fields()->createMany($fields['fields']);
        }

        return $profile;
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

        return $profile;
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
        return response(null, 204);
    }
}
