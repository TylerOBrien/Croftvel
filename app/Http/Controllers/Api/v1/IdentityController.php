<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Identity\{ IndexIdentity, ShowIdentity, StoreIdentity, UpdateIdentity, VerifyIdentity, DestroyIdentity };
use App\Models\Identity;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class IdentityController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the identity.
     * 
     * @param IndexIdentity $request
     *
     * @return Response
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
     * @param Identity $identity
     * @param ShowIdentity $request
     *
     * @return Response
     */
    public function show(Identity $identity, ShowIdentity $request)
    {
        return $identity;
    }

    /**
     * Store a newly created identity in storage.
     * 
     * @param StoreIdentity $request
     *
     * @return Response
     */
    public function store(StoreIdentity $request)
    {
        $fields = $request->validated();
        $identity_id = Identity::create($fields)->id;

        return Identity::find($identity_id);
    }

    /**
     * Update the specified identity in storage.
     * 
     * @param Identity $identity
     * @param UpdateIdentity $request
     * 
     * @return Response
     */
    public function update(Identity $identity, UpdateIdentity $request)
    {
        $fields = $request->validated();

        $identity->fill($fields);
        $identity->save();

        return $identity->only(array_keys($fields));
    }

    /**
     * Verify the specified identity.
     * 
     * @param Identity $identity
     * @param UpdateIdentity $request
     * 
     * @return Response
     */
    public function verify(Identity $identity, VerifyIdentity $request)
    {
        $identity->attemptVerify($request->validated());
        return response()->json(null, 204);
    }

    /**
     * Remove the specified identity from storage.
     * 
     * @param Identity $identity
     * @param DestroyIdentity $request
     *
     * @return Response
     */
    public function destroy(Identity $identity, DestroyIdentity $request)
    {
        $identity->delete();
        return response()->json(null, 204);
    }
}
