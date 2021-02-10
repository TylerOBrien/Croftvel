<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\Storage;

trait HasFileUpload
{
    /**
     * @return Model
     */
    static public function createFromFile($file, array $attributes, string $dest=null, string $disk=null)
    {
        $disk = $disk ?? config('croft.uploads.default.disk');
        $dest = $dest ?? config('croft.uploads.default.dir');

        $filesize = filesize($file);
        $mimetype = $file->getMimeType();
        $filepath = Storage::disk($disk)->put($dest, $file);

        return self::create(array_merge($attributes, compact('disk', 'filesize', 'filepath', 'mimetype')));
    }

    /**
     * @return bool
     */
    public function updateFromFile($file, array $attributes, string $dest=null)
    {
        $dest = $dest ?? config('croft.uploads.default.dir');
        
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
