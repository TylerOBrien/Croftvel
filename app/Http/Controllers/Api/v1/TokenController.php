<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Token\{ IndexToken, ShowToken, StoreToken, UpdateToken, DestroyToken };
use App\Http\Resources\Api\v1\TokenResource;
use App\Models\PersonalAccessToken;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class TokenController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the token.
     * 
     * @param IndexToken $request
     *
     * @return Response
     */
    public function index(IndexToken $request)
    {
        $fields = $request->validated();
        $tokens = PersonalAccessToken::select();

        return $this->filtered($tokens, $fields);
    }

    /**
     * Display the specified token.
     * 
     * @param PersonalAccessToken $token
     * @param ShowToken $request
     *
     * @return Response
     */
    public function show(PersonalAccessToken $token, ShowToken $request)
    {
        return $token;
    }

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
        $user = auth()->attempt($fields);
        $pat = $user->createToken(config('croft.token.name'));
        $token = new TokenResource($pat);

        return compact('token', 'user');
    }

    /**
     * Update the specified token in storage.
     * 
     * @param PersonalAccessToken $token
     * @param UpdateToken $request
     * 
     * @return Response
     */
    public function update(PersonalAccessToken $token, UpdateToken $request)
    {
        $fields = $request->validated();

        $token->fill($fields);
        $token->save();

        return $token->only(array_keys($fields));
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
