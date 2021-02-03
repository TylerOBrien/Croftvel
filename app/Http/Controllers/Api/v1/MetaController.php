<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Meta;
use App\Traits\Controllers\Api\v1\HasQueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Meta\{ IndexMeta, ShowMeta, StoreMeta, UpdateMeta, DestroyMeta };

class MetaController extends Controller
{
    use HasQueryFilter;

    /**
     * Display a listing of the metas.
     * 
     * @param IndexMeta $request
     *
     * @return Response
     */
    public function index(IndexMeta $request)
    {
        $fields = $request->validated();
        $metas = Meta::select();

        return $this->filtered($metas, $fields)
                    ->with(config('croft.relationships.meta.index'))
                    ->get()
                    ->each->append(config('croft.attributes.meta.index'));
    }

    /**
     * Display the specified meta.
     * 
     * @param Meta $meta
     * @param ShowMeta $request
     *
     * @return Response
     */
    public function show(Meta $meta, ShowMeta $request)
    {
        return $meta->load(config('croft.relationships.meta.show'))
                    ->append(config('croft.attributes.meta.show'));
    }

    /**
     * Store a newly created meta in storage.
     * 
     * @param StoreMeta $request
     *
     * @return Response
     */
    public function store(StoreMeta $request)
    {
        $fields = $request->validated();
        $meta_id = Meta::create($fields)->id;

        return Meta::find($meta_id)
                   ->load(config('croft.relationships.meta.store'))
                   ->append(config('croft.attributes.meta.store'));
    }

    /**
     * Update the specified image in storage.
     * 
     * @param Meta $meta
     * @param UpdateMeta $request
     *
     * @return Response
     */
    public function update(Meta $meta, UpdateMeta $request)
    {
        $fields = $request->validated();

        $meta->fill($fields);
        $meta->save();

        return $meta->only(array_keys($fields));
    }

    /**
     * Remove the specified meta from storage.
     * 
     * @param Meta $meta
     * @param DestroyMeta $request
     * 
     * @return Response
     */
    public function destroy(Meta $meta, DestroyMeta $request)
    {
        $meta->delete();
        return response()->json(null, 204);
    }
}
