<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileField\{ IndexProfileField, ShowProfileField, StoreProfileField, UpdateProfileField, DestroyProfileField };
use App\Models\{ Profile, ProfileField };
use App\Traits\Controllers\Api\v1\HasQueryFilter;

class ProfileFieldController extends Controller
{
    use HasQueryFilter;

    /**
     * Display a listing of the profile fields.
     *
     * @param  \App\Http\Requests\Api\v1\ProfileField\IndexProfileField  $request
     * @param  \App\Models\Profile  $profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexProfileField $request, Profile $profile = null)
    {
        $fields = $request->validated();

        if ($profile) {
            $profile_fields = $profile->fields();
        } else {
            $profile_fields = ProfileField::select();
        }

        return $this->filtered($profile_fields, $fields);
    }

    /**
     * Display the specified profile field.
     *
     * @param  \App\Models\ProfileField  $profile_field
     * @param  \App\Http\Requests\Api\v1\ProfileField\ShowProfileField  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileField $profile_field, ShowProfileField $request)
    {
        return $profile_field;
    }

    /**
     * Store a newly created profile field in storage.
     *
     * @param  \App\Http\Requests\Api\v1\ProfileField\StoreProfileField  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileField $request)
    {
        $fields = $request->validated();

        return ProfileField::create($fields);
    }

    /**
     * Update the specified profile field in storage.
     *
     * @param  \App\Models\ProfileField  $profile_field
     * @param  \App\Http\Requests\Api\v1\ProfileField\UpdateProfileField  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileField $profile_field, UpdateProfileField $request)
    {
        $fields = $request->validated();

        $profile_field->fill($fields);
        $profile_field->save();

        return $profile_field;
    }

    /**
     * Remove the specified profile field from storage.
     *
     * @param  \App\Models\ProfileField  $profile_field
     * @param  \App\Http\Requests\Api\v1\ProfileField\DestroyProfileField  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileField $profile_field, DestroyProfileField $request)
    {
        $profile_field->delete();
        return response(null, 204);
    }
}
