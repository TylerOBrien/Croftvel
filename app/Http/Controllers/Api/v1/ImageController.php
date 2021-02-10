<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Image;
use App\Traits\Controllers\Api\v1\HasQueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Image\{ IndexImage, ShowImage, StoreImage, UpdateImage, DestroyImage };

class ImageController extends Controller
{
    use HasQueryFilter;

    /**
     * Display a listing of the images.
     * 
     * @param IndexImage $request
     *
     * @return Response
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
     * @param Image $image
     * @param ShowImage $request
     *
     * @return Response
     */
    public function show(Image $image, ShowImage $request)
    {
        return $image;
    }

    /**
     * Store a newly created image in storage.
     * 
     * @param StoreImage $request
     *
     * @return Response
     */
    public function store(StoreImage $request)
    {
        $fields = $request->validated();
        $file = $request->file('image');
        $image_id = Image::createFromFile($fields, $file)->id;

        return Image::find($image_id);
    }

    /**
     * Update the specified image in storage.
     * 
     * @param Image $image
     * @param UpdateImage $request
     * 
     * @return Response
     */
    public function update(Image $image, UpdateImage $request)
    {
        $fields = $request->validated();
        $file = $request->file('image');

        if ($file) {
            $image->updateFromFile($fields, $file);
            unset($fields['image']);
        } else {
            $image->fill($fields)->save();
        }

        return $image;
    }

    /**
     * Remove the specified image from storage.
     * 
     * @param Image $image
     * @param DestroyImage $request
     * 
     * @return Response
     */
    public function destroy(Image $image, DestroyImage $request)
    {
        $image->delete();
        return response()->json(null, 204);
    }
}
