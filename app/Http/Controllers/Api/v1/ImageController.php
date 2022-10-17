<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Image\{ IndexImage, ShowImage, StoreImage, UpdateImage, DestroyImage };
use App\Models\Image;
use App\Traits\Controllers\Api\v1\HasQueryFilter;

class ImageController extends Controller
{
    use HasQueryFilter;

    /**
     * Display a listing of the images.
     *
     * @param  \App\Http\Requests\Api\v1\Image\IndexImage  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexImage $request)
    {
        $fields = $request->validated();
        $images = Image::select();

        return $this->filtered($images, $fields);
    }

    /**
     * Display the specified image.
     *
     * @param  \App\Models\Image  $image
     * @param  \App\Http\Requests\Api\v1\Image\ShowImage  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image, ShowImage $request)
    {
        return $image;
    }

    /**
     * Store a newly created image in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Image\StoreImage  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImage $request)
    {
        $fields = $request->validated();
        $file = $request->file('image');

        return Image::createFromFile($file, $fields);
    }

    /**
     * Update the specified image in storage.
     *
     * @param  \App\Models\Image  $image
     * @param  \App\Http\Requests\Api\v1\Image\UpdateImage  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Image $image, UpdateImage $request)
    {
        $fields = $request->validated();
        $file = $request->file('image');

        if ($file) {
            $image->updateFromFile($file, $fields);
        } else {
            $image->fill($fields)->save();
        }

        return $image;
    }

    /**
     * Remove the specified image from storage.
     *
     * @param  \App\Models\Image  $image
     * @param  \App\Http\Requests\Api\v1\Image\DestroyImage  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image, DestroyImage $request)
    {
        $image->delete();
        return response(null, 204);
    }
}
