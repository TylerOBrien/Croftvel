<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\TokenResource;
use App\Http\Requests\Api\v1\Token\{ StoreToken, DestroyToken };
use App\Models\PersonalAccessToken;

class TokenController extends Controller
{
    /**
     * Store a newly created token in storage.
     * 
     * @param StoreToken $request
     *
     * @return Response
     */
    public function store(StoreToken $request)
    {
        $fields = $request->validated();
        $identity = auth()->attempt($fields);
        $pat = $identity->user->createToken(config('croft.token.name'));
        $token = new TokenResource($pat);

        return compact('identity', 'token');
    }

    /**
     * Remove the specified token from storage.
     * 
     * @param PersonalAccessToken $token
     * @param DestroyToken $request
     *
     * @return Response
     */
    public function destroy(PersonalAccessToken $token, DestroyToken $request)
    {
        $token->delete();
        return response()->json(null, 204);
    }
}
