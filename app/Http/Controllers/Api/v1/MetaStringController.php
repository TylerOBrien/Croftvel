<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\MetaString\{ IndexMetaString, ShowMetaString, StoreMetaString, UpdateMetaString, DestroyMetaString };
use App\Models\{ Meta, MetaString };
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class MetaStringController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the meta strings.
     * 
     * @param  Meta  $meta
     * @param  IndexMetaString  $request
     *
     * @return Response
     */
    public function index(Meta $meta, IndexMetaString $request)
    {
        $fields = $request->validated();
        $strings = MetaString::select();

        return $this->filtered($strings, $fields);
    }

    /**
     * Display the specified meta string.
     * 
     * @param  Meta  $meta
     * @param  MetaString  $string
     * @param  ShowMetaString  $request
     *
     * @return Response
     */
    public function show(Meta $meta, MetaString $string, ShowMetaString $request)
    {
        return $string;
    }

    /**
     * Store a newly created meta string in storage.
     * 
     * @param  Meta  $meta
     * @param  StoreMetaString  $request
     *
     * @return Response
     */
    public function store(Meta $meta, StoreMetaString $request)
    {
        $fields = array_merge($request->validated(), [
            'meta_id' => $meta->id
        ]);

        return MetaString::create($fields);
    }

    /**
     * Update the specified meta string in storage.
     * 
     * @param  Meta  $meta
     * @param  MetaString  $string
     * @param  UpdateMetaString  $request
     *
     * @return Response
     */
    public function update(Meta $meta, MetaString $string, UpdateMetaString $request)
    {
        $fields = $request->validated();

        $string->fill($fields);
        $string->save();

        return $string->only(array_keys($fields));
    }

    /**
     * Remove the specified meta string from storage.
     * 
     * @param  Meta  $meta
     * @param  MetaString  $string
     * @param  DestroyMetaString  $request
     * 
     * @return Response
     */
    public function destroy(Meta $meta, MetaString $string, DestroyMetaString $request)
    {
        $string->delete();
        return response()->json(null, 204);
    }
}
