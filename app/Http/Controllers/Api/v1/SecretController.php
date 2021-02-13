<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Secret\{ IndexSecret, ShowSecret, StoreSecret, UpdateSecret, DestroySecret };
use App\Models\{ User, Secret };
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class SecretController extends Controller
{
    use HasControllerHelpers;
    
    /**
     * Display a listing of the secret.
     * 
     * @param  \App\Http\Requests\Api\v1\Secret\IndexSecret  $request
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexSecret $request, User $user = null)
    {
        $fields = $request->validated();
        $secrets = Secret::select();

        return $this->filtered($secrets, $fields);
    }

    /**
     * Display the specified secret.
     * 
     * @param  \App\Models\Secret  $secret
     * @param  \App\Http\Requests\Api\v1\Secret\ShowSecret  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Secret $secret, ShowSecret $request)
    {
        return $secret;
    }

    /**
     * Store a newly created secret in storage.
     * 
     * @param  \App\Http\Requests\Api\v1\Secret\StoreSecret  $request
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSecret $request, User $user = null)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => $user->id ?? request('user_id')
        ]);

        return Secret::create($fields);
    }

    /**
     * Update the specified secret in storage.
     * 
     * @param  \App\Models\Secret  $secret
     * @param  \App\Http\Requests\Api\v1\Secret\UpdateSecret  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Secret $secret, UpdateSecret $request)
    {
        $fields = $request->validated();

        $secret->fill($fields);
        $secret->save();

        return $secret->only(array_keys($fields));
    }

    /**
     * Remove the specified secret from storage.
     * 
     * @param  \App\Models\Secret  $secret
     * @param  \App\Http\Requests\Api\v1\Secret\DestroySecret  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secret $secret, DestroySecret $request)
    {
        $secret->delete();
        return response()->json(null, 204);
    }
}
