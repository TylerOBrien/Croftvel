<?php

namespace App\Http\Controllers\Api\v1;

use App\Guards\Api\v1\ApiGuard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Identity\{ IndexIdentity, ShowIdentity, StoreIdentity, UpdateIdentity, DestroyIdentity };
use App\Models\Identity;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class IdentityController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the identities.
     *
     * @param  \App\Http\Requests\Api\v1\Identity\IndexIdentity  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexIdentity $request)
    {
        $fields = $request->validated();
        $identities = Identity::select();

        return $this->filtered($identities, $fields);
    }

    /**
     * Display the specified identity.
     *
     * @param  \App\Models\Identity  $identity
     * @param  \App\Http\Requests\Api\v1\Identity\ShowIdentity  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Identity $identity, ShowIdentity $request)
    {
        return $identity;
    }

    /**
     * Store a newly created identity in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Identity\StoreIdentity  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdentity $request)
    {
        $fields = $request->validated();
        $guard = ApiGuard::get();

        $guard->attempt([
            'identity' => $guard->identity()->toTypeValue(),
            'secret' => $fields['current_secret'],
        ]);

        return Identity::create($fields);
    }

    /**
     * Update the specified identity in storage.
     *
     * @param  \App\Models\Identity  $identity
     * @param  \App\Http\Requests\Api\v1\Identity\UpdateIdentity  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Identity $identity, UpdateIdentity $request)
    {
        $fields = $request->validated();
        $guard = ApiGuard::get();

        $guard->attempt([
            'identity' => $guard->identity()->toTypeValue(),
            'secret' => $fields['current_secret'],
        ]);

        $identity->fill($fields);
        $identity->save();

        return $identity;
    }

    /**
     * Remove the specified identity from storage.
     *
     * @param  \App\Models\Identity  $identity
     * @param  \App\Http\Requests\Api\v1\Identity\DestroyIdentity  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Identity $identity, DestroyIdentity $request)
    {
        $identity->delete();
        return response(null, 204);
    }
}
