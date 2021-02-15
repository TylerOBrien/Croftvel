<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\File\{ IndexFile, ShowFile, StoreFile, UpdateFile, DestroyFile };
use App\Models\File;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class FileController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the file.
     * 
     * @param  IndexFile  $request
     *
     * @return Response
     */
    public function index(IndexFile $request)
    {
        $fields = $request->validated();
        $files = File::select();

        return $this->filtered($files, $fields);
    }

    /**
     * Display the specified file.
     * 
     * @param  File  $file
     * @param  ShowFile  $request
     *
     * @return Response
     */
    public function show(File $file, ShowFile $request)
    {
        return $file;
    }

    /**
     * Store a newly created file in storage.
     * 
     * @param  StoreFile  $request
     *
     * @return Response
     */
    public function store(StoreFile $request)
    {
        $fields = $request->validated();
        $given = $request->file('file');

        return File::createFromFile($given, $fields);
    }

    /**
     * Update the specified file in storage.
     * 
     * @param  File  $file
     * @param  UpdateFile  $request
     * 
     * @return Response
     */
    public function update(File $file, UpdateFile $request)
    {
        $fields = $request->validated();
        $given = $request->file('file');

        if ($given) {
            $file->updateFromFile($given, $fields);
        } else {
            $file->fill($fields)->save();
        }

        return $file;
    }

    /**
     * Remove the specified file from storage.
     * 
     * @param  File  $file
     * @param  DestroyFile  $request
     *
     * @return Response
     */
    public function destroy(File $file, DestroyFile $request)
    {
        $file->delete();
        return response()->json(null, 204);
    }
}
