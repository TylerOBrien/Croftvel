<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Secret\{ IndexSecret, ShowSecret, StoreSecret, UpdateSecret, DestroySecret };
use App\Models\Secret;

class SecretController extends Controller
{
    /**
     * Display a listing of the secret.
     * 
     * @param IndexSecret $request
     *
     * @return Response
     */
    public function index(IndexSecret $request)
    {
        return Secret::all();
    }

    /**
     * Display the specified secret.
     * 
     * @param Secret $secret
     * @param ShowSecret $request
     *
     * @return Response
     */
    public function show(Secret $secret, ShowSecret $request)
    {
        return $secret;
    }

    /**
     * Store a newly created secret in storage.
     * 
     * @param StoreSecret $request
     *
     * @return Response
     */
    public function store(StoreSecret $request)
    {
        $fields = $request->validated();
        $secretId = Secret::create($fields)->id;

        return Secret::find($secretId);
    }

    /**
     * Update the specified secret in storage.
     * 
     * @param Secret $secret
     * @param UpdateSecret $request
     * 
     * @return Response
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
     * @param Secret $secret
     * @param DestroySecret $request
     *
     * @return Response
     */
    public function destroy(Secret $secret, DestroySecret $request)
    {
        $secret->delete();
        return response()->json(null, 204);
    }
}
