<?php

namespace App\Traits\Models;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasFileUpload
{
    /**
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  array  $attributes
     * @param  string  $dest
     * @param  string  $disk
     *
     * @return Model
     */
    static public function createFromFile(UploadedFile $file, array $attributes, string $dest = null, string $disk = null)
    {
        $dest = $dest ?? config('uploads.default.dir');
        $disk = $disk ?? config('uploads.default.disk');

        $filesize = filesize($file);
        $mimetype = $file->getMimeType();
        $filepath = Storage::disk($disk)->put($dest, $file);

        return self::create(array_merge($attributes, compact('disk', 'filesize', 'filepath', 'mimetype')));
    }

    /**
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  array  $attributes
     * @param  string  $dest
     *
     * @return bool
     */
    public function updateFromFile(UploadedFile $file, array $attributes, string $dest = null) : bool
    {
        $dest = $dest ?? config('uploads.default.dir');

        $storage = Storage::disk($this->disk);
        $storage->delete($this->filepath);

        $filesize = filesize($file);
        $mimetype = $file->getMimeType();
        $filepath = $storage->put($dest, $file);

        $this->fill(array_merge($attributes, compact('filesize', 'filepath', 'mimetype')));

        return $this->save();
    }

    /**
     * @return bool
     */
    public function delete() : bool
    {
        Storage::disk($this->disk)->delete($this->filepath);
        return parent::delete();
    }

    /**
     * @return string
     */
    public function getUrlAttribute() : string
    {
        return Storage::disk($this->disk)->url($this->filepath);
    }
}
