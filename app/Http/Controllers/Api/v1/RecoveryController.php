<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Recovery\{ IndexRecovery, ShowRecovery, StoreRecovery, UpdateRecovery, DestroyRecovery };
use App\Models\{ Identity, Recovery };
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class RecoveryController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the recoveries.
     * 
     * @param  \App\Http\Requests\Api\v1\Recovery\IndexRecovery  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRecovery $request)
    {
        $fields = $request->validated();
        $recoveries = Recovery::select();

        return $this->filtered($recoveries, $fields);
    }

    /**
     * Display the specified recovery.
     * 
     * @param  \App\Models\Recovery  $recovery
     * @param  \App\Http\Requests\Api\v1\Recovery\ShowRecovery  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Recovery $recovery, ShowRecovery $request)
    {
        return $recovery;
    }

    /**
     * Store a newly created recovery in storage.
     * 
     * @param  \App\Http\Requests\Api\v1\Recovery\StoreRecovery  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecovery $request)
    {
        $code = Recovery::makeUniqueString('code', config('croft.recovery.length'), 'sha256');
        $identity_id = Identity::findByRequest($request)->id;
        $fields = array_merge($request->validated(), [
            'code' => $code,
            'identity_id' => $identity_id
        ]);

        return Recovery::create($fields);
    }

    /**
     * Update the specified recovery in storage.
     * 
     * @param  \App\Models\Recovery  $recovery
     * @param  \App\Http\Requests\Api\v1\Recovery\UpdateRecovery  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Recovery $recovery, UpdateRecovery $request)
    {
        $fields = $request->validated();

        $recovery->fill($fields);
        $recovery->save();

        return $recovery->only(array_keys($fields));
    }

    /**
     * Remove the specified recovery from storage.
     * 
     * @param  \App\Models\Recovery  $recovery
     * @param  \App\Http\Requests\Api\v1\Recovery\DestroyRecovery  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recovery $recovery, DestroyRecovery $request)
    {
        $recovery->delete();
        return response()->json(null, 204);
    }
}
