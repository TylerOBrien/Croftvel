<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\Storage;

trait HasFileUpload
{
    /**
     * 
     */
    static public function createFromFile($folder, $file, $attributes)
    {
        $disk = config('croft.uploads.disk');
        $filesize = filesize($file);
        $mimetype = $file->getMimeType();
        $filepath = Storage::disk($disk)->put($folder, $file);

        return self::create(
            array_merge($attributes, compact('disk', 'filesize', 'filepath', 'mimetype'))
        );
    }

    /**
     * 
     */
    static public function updateFromFile($model, $folder, $file, $attributes)
    {
        $storage = Storage::disk($model->disk);
        $storage->delete($model->filepath);

        $filesize = filesize($file);
        $mimetype = $file->getMimeType();
        $filepath = $storage->put($folder, $file);

        return $model->fill(array_merge($attributes, compact('filesize', 'filepath', 'mimetype')))
                     ->save();
    }

    /**
     * 
     */
    public function delete()
    {
        Storage::disk($this->disk)->delete($this->filepath);

        return parent::delete();
    }

    /**
     * 
     */
    public function getUrlAttribute()
    {
        return Storage::disk($this->disk)->url($this->filepath);
    }
}