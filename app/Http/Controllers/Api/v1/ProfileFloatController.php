<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProfileFloat\{ IndexProfileFloat, ShowProfileFloat, StoreProfileFloat, UpdateProfileFloat, DestroyProfileFloat };
use App\Models\{ Profile, ProfileFloat };
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class ProfileFloatController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the profile float.
     * 
     * @param  Profile  $profile
     * @param  IndexProfileFloat  $request
     *
     * @return Response
     */
    public function index(Profile $profile, IndexProfileFloat $request)
    {
        $fields = $request->validated();
        $floats = ProfileFloat::select();

        return $this->filtered($floats, $fields);
    }

    /**
     * Display the specified profile float.
     * 
     * @param  Profile  $profile
     * @param  ProfileFloat  $float
     * @param  ShowProfileFloat  $request
     *
     * @return Response
     */
    public function show(Profile $profile, ProfileFloat $float, ShowProfileFloat $request)
    {
        return $float;
    }

    /**
     * Store a newly created profile float in storage.
     * 
     * @param  Profile  $profile
     * @param  StoreProfileFloat  $request
     *
     * @return Response
     */
    public function store(Profile $profile, StoreProfileFloat $request)
    {
        $fields = array_merge($request->validated(), [
            'profile_id' => $profile->id
        ]);

        return ProfileFloat::create($fields);
    }

    /**
     * Update the specified profile float in storage.
     * 
     * @param  Profile  $profile
     * @param  ProfileFloat  $float
     * @param  UpdateProfileFloat  $request
     * 
     * @return Response
     */
    public function update(Profile $profile, ProfileFloat $float, UpdateProfileFloat $request)
    {
        $fields = $request->validated();

        $float->fill($fields);
        $float->save();

        return $float->only(array_keys($fields));
    }

    /**
     * Remove the specified profile float from storage.
     * 
     * @param  Profile  $profile
     * @param  ProfileFloat  $float
     * @param  DestroyProfileFloat  $request
     *
     * @return Response
     */
    public function destroy(Profile $profile, ProfileFloat $float, DestroyProfileFloat $request)
    {
        $float->delete();
        return response()->json(null, 204);
    }
}
