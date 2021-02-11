<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Verification\{ IndexVerification, ShowVerification, StoreVerification, UpdateVerification, DestroyVerification };
use App\Models\Verification;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class VerificationController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the verification.
     * 
     * @param  IndexVerification  $request
     *
     * @return Response
     */
    public function index(IndexVerification $request)
    {
        $fields = $request->validated();
        $verifications = Verification::select();

        return $this->filtered($verifications, $fields);
    }

    /**
     * Display the specified verification.
     * 
     * @param  Verification  $verification
     * @param  ShowVerification  $request
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
     * @param  StoreVerification  $request
     *
     * @return Response
     */
    public function store(StoreVerification $request)
    {
        $code = Verification::makeUniqueInt('code', config('croft.verification.length'), 'sha256');
        $fields = array_merge($request->validated(), [
            'code' => $code
        ]);

        return Verification::create($fields);
    }

    /**
     * Remove the specified verification from storage.
     * 
     * @param  Verification  $verification
     * @param  DestroyVerification  $request
     *
     * @return Response
     */
    public function destroy(Verification $verification, DestroyVerification $request)
    {
        $verification->delete();
        return response()->json(null, 204);
    }
}
