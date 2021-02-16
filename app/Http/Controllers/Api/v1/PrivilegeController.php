<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Privilege\{ IndexPrivilege, ShowPrivilege, StorePrivilege, UpdatePrivilege, DestroyPrivilege };
use App\Models\Privilege;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class PrivilegeController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the privileges.
     * 
     * @param  \App\Http\Requests\Api\v1\Privilege\IndexPrivilege  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexPrivilege $request)
    {
        $fields = $request->validated();
        $privileges = Privilege::select();

        return $this->filtered($privileges, $fields);
    }

    /**
     * Display the specified privilege.
     * 
     * @param  \App\Models\Privilege  $privilege
     * @param  \App\Http\Requests\Api\v1\Privilege\ShowPrivilege  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Privilege $privilege, ShowPrivilege $request)
    {
        return $privilege;
    }

    /**
     * Store a newly created privilege in storage.
     * 
     * @param  \App\Http\Requests\Api\v1\Privilege\StorePrivilege  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrivilege $request)
    {
        $fields = $request->validated();

        return Privilege::create($fields)->fresh();
    }

    /**
     * Update the specified privilege in storage.
     * 
     * @param  \App\Models\Privilege  $privilege
     * @param  \App\Http\Requests\Api\v1\Privilege\UpdatePrivilege  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Privilege $privilege, UpdatePrivilege $request)
    {
        $fields = $request->validated();

        $privilege->fill($fields);
        $privilege->save();

        return $privilege;
    }

    /**
     * Remove the specified privilege from storage.
     * 
     * @param  \App\Models\Privilege  $privilege
     * @param  \App\Http\Requests\Api\v1\Privilege\DestroyPrivilege  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Privilege $privilege, DestroyPrivilege $request)
    {
        $privilege->delete();
        return response()->json(null, 204);
    }
}
