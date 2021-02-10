<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\File;
use App\Traits\Controllers\Api\v1\HasQueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\File\{ IndexFile, ShowFile, StoreFile, UpdateFile, DestroyFile };

class FileController extends Controller
{
    use HasQueryFilter;

    /**
     * Display a listing of the file.
     * 
     * @param IndexFile $request
     *
     * @return Response
     */
    public function index(IndexFile $request)
    {
        $fields = $request->validated();
        $files = File::select();

        return $this->filtered($files, $fields)
                    ->with(config('croft.relationships.file.index'))
                    ->get()
                    ->each->append(config('croft.attributes.file.index'));
    }

    /**
     * Display the specified file.
     * 
     * @param File $file
     * @param ShowFile $request
     *
     * @return Response
     */
    public function show(File $file, ShowFile $request)
    {
        return $file->load(config('croft.relationships.file.show'))
                    ->append(config('croft.attributes.file.show'));
    }

    /**
     * Store a newly created file in storage.
     * 
     * @param StoreFile $request
     *
     * @return Response
     */
    public function store(StoreFile $request)
    {
        $fields = $request->validated();
        $given = $request->file('file');
        $file_id = File::createFromFile($fields, $given)->id;

        return File::find($file_id)
                   ->load(config('croft.relationships.file.store'))
                   ->append(config('croft.attributes.file.store'));
    }

    /**
     * Update the specified file in storage.
     * 
     * @param File $file
     * @param UpdateFile $request
     * 
     * @return Response
     */
    public function update(File $file, UpdateFile $request)
    {
        $fields = $request->validated();
        $given = $request->file('file');

        return $file->updateFromFile($fields, $given)
                    ->load(config('croft.relationships.file.show'))
                    ->append(config('croft.attributes.file.show'));
    }

    /**
     * Remove the specified file from storage.
     * 
     * @param File $file
     * @param DestroyFile $request
     *
     * @return Response
     */
    public function destroy(File $file, DestroyFile $request)
    {
        $file->delete();
        return response()->json(null, 204);
    }
}