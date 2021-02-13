<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\MetaInteger\{ IndexMetaInteger, ShowMetaInteger, StoreMetaInteger, UpdateMetaInteger, DestroyMetaInteger };
use App\Models\{ Meta, MetaInteger };
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class MetaIntegerController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the meta integers.
     * 
     * @param  Meta  $meta
     * @param  IndexMetaInteger  $request
     *
     * @return Response
     */
    public function index(Meta $meta, IndexMetaInteger $request)
    {
        $fields = $request->validated();
        $integers = MetaInteger::select();

        return $this->filtered($integers, $fields);
    }

    /**
     * Display the specified meta integer.
     * 
     * @param  Meta  $meta
     * @param  MetaInteger  $integer
     * @param  ShowMetaInteger  $request
     *
     * @return Response
     */
    public function show(Meta $meta, MetaInteger $integer, ShowMetaInteger $request)
    {
        return $integer;
    }

    /**
     * Store a newly created meta integer in storage.
     * 
     * @param  Meta  $meta
     * @param  StoreMetaInteger  $request
     *
     * @return Response
     */
    public function store(Meta $meta, StoreMetaInteger $request)
    {
        $fields = array_merge($request->validated(), [
            'meta_id' => $meta->id
        ]);

        return MetaInteger::create($fields);
    }

    /**
     * Update the specified meta integer in storage.
     * 
     * @param  Meta  $meta
     * @param  MetaInteger  $integer
     * @param  UpdateMetaInteger  $request
     *
     * @return Response
     */
    public function update(Meta $meta, MetaInteger $integer, UpdateMetaInteger $request)
    {
        $fields = $request->validated();

        $integer->fill($fields);
        $integer->save();

        return $integer->only(array_keys($fields));
    }

    /**
     * Remove the specified meta integer from storage.
     * 
     * @param  Meta  $meta
     * @param  MetaInteger  $integer
     * @param  DestroyMetaInteger  $request
     * 
     * @return Response
     */
    public function destroy(Meta $meta, MetaInteger $integer, DestroyMetaInteger $request)
    {
        $integer->delete();
        return response()->json(null, 204);
    }
}
