<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\Storage;

trait HasFileUpload
{
    /**
     * @return Model
     */
    static public function createFromFile($file, array $attributes, string $dest, string $disk=null)
    {
        $disk = $disk ?? config('croft.uploads.disk');
        $filesize = filesize($file);
        $mimetype = $file->getMimeType();
        $filepath = Storage::disk($disk)->put($dest, $file);

        return self::create(array_merge($attributes, compact('disk', 'filesize', 'filepath', 'mimetype')));
    }

    /**
     * @return Model
     */
    public function updateFromFile($file, array $attributes, string $dest)
    {
        $storage = Storage::disk($this->disk);
        $storage->delete($this->filepath);

        $filesize = filesize($file);
        $mimetype = $file->getMimeType();
        $filepath = $storage->put($dest, $file);

        return $this->fill(array_merge($attributes, compact('filesize', 'filepath', 'mimetype')))
                    ->save();
    }

    /**
     * @return Model
     */
    public function delete()
    {
        Storage::disk($this->disk)->delete($this->filepath);
        return parent::delete();
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return Storage::disk($this->disk)->url($this->filepath);
    }
}