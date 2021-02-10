<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Video\{ IndexVideo, ShowVideo, StoreVideo, UpdateVideo, DestroyVideo };
use App\Models\Video;

class VideoController extends Controller
{
    /**
     * Display a listing of the video.
     * 
     * @param IndexVideo $request
     *
     * @return Response
     */
    public function index(IndexVideo $request)
    {
        return Video::all();
    }

    /**
     * Display the specified video.
     * 
     * @param Video $video
     * @param ShowVideo $request
     *
     * @return Response
     */
    public function show(Video $video, ShowVideo $request)
    {
        return $video;
    }

    /**
     * Store a newly created video in storage.
     * 
     * @param StoreVideo $request
     *
     * @return Response
     */
    public function store(StoreVideo $request)
    {
        $fields = $request->validated();
        $videoId = Video::create($fields)->id;

        return Video::find($videoId);
    }

    /**
     * Update the specified video in storage.
     * 
     * @param Video $video
     * @param UpdateVideo $request
     * 
     * @return Response
     */
    public function update(Video $video, UpdateVideo $request)
    {
        $fields = $request->validated();

        $video->fill($fields);
        $video->save();

        return $video->only(array_keys($fields));
    }

    /**
     * Remove the specified video from storage.
     * 
     * @param Video $video
     * @param DestroyVideo $request
     *
     * @return Response
     */
    public function destroy(Video $video, DestroyVideo $request)
    {
        $video->delete();
        return response()->json(null, 204);
    }
}
