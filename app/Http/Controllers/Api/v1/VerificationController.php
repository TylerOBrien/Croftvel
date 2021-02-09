<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Verification\{ IndexVerification, ShowVerification, StoreVerification, UpdateVerification, DestroyVerification };
use App\Models\Verification;

use Illuminate\Support\Carbon;

class VerificationController extends Controller
{
    /**
     * Display a listing of the verification.
     * 
     * @param IndexVerification $request
     *
     * @return Response
     */
    public function index(IndexVerification $request)
    {
        return Verification::all();
    }

    /**
     * Display the specified verification.
     * 
     * @param Verification $verification
     * @param ShowVerification $request
     *
     * @return Response
     */
    public function show(Verification $verification, ShowVerification $request)
    {
        return $verification;
    }

    /**
     * Store a newly created verification in storage.
     * 
     * @param StoreVerification $request
     *
     * @return Response
     */
    public function store(StoreVerification $request)
    {
        $fields = $request->validated();
        $verification_id = Verification::create($fields)->id;

        return Verification::find($verification_id);
    }

    /**
     * Remove the specified verification from storage.
     * 
     * @param Verification $verification
     * @param DestroyVerification $request
     *
     * @return Response
     */
    public function destroy(Verification $verification, DestroyVerification $request)
    {
        $verification->delete();
        return response()->json(null, 204);
    }
}
