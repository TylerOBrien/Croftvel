<?php

namespace App\Traits\Models;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasFileUpload
{
    /**
     * Create a new instance of this model using the given uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file  The file uploaded by a user.
     * @param  array  $attributes  The attributes to pass to the create function.
     * @param  string|null  $dest  The filepath destination on the disk where the file will be saved.
     * @param  string|null  $disk  The disk to use for storage.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    static public function createFromFile(UploadedFile $file, array $attributes, string|null $dest = null, string|null $disk = null)
    {
        $dest = $dest ?? config('uploads.default.dest');
        $disk = $disk ?? config('uploads.default.disk');

        $filesize = filesize($file);
        $mimetype = $file->getMimeType();
        $filepath = Storage::disk($disk)->put($dest, $file);

        return self::create(array_merge($attributes, compact('disk', 'filesize', 'filepath', 'mimetype')));
    }

    /**
     * Modifies an existing instance of this model using the given uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file  The file uploaded by a user.
     * @param  array  $attributes  The attributes to pass to the create function.
     * @param  string|null  $dest  The filepath destination on the disk where the file will be saved.
     *
     * @return bool
     */
    public function updateFromFile(UploadedFile $file, array $attributes, string|null $dest = null) : bool
    {
        $dest = $dest ?? config('uploads.default.dest');

        $storage = Storage::disk($this->disk);
        $storage->delete($this->filepath);

        $filesize = filesize($file);
        $mimetype = $file->getMimeType();
        $filepath = $storage->put($dest, $file);

        $this->fill(array_merge($attributes, compact('filesize', 'filepath', 'mimetype')));

        return $this->save();
    }

    /**
     * Deletes the file from file disk storage as well as database storage.
     *
     * @return bool
     */
    public function delete() : bool
    {
        Storage::disk($this->disk)->delete($this->filepath);
        return parent::delete();
    }

    /**
     * Retreives the full URL for this file.
     *
     * @return string
     */
    public function getUrlAttribute() : string
    {
        return Storage::disk($this->disk)->url($this->filepath);
    }
}
