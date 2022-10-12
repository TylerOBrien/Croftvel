<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Video\{ IndexVideo, ShowVideo, StoreVideo, UpdateVideo, DestroyVideo };
use App\Models\Video;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class VideoController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the video.
     *
     * @param  \App\Http\Requests\Api\v1\Video\IndexVideo $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexVideo $request)
    {
        $fields = $request->validated();
        $videos = Video::select();

        return $this->filtered($videos, $fields);
    }

    /**
     * Display the specified video.
     *
     * @param  \App\Models\Video $video
     * @param  \App\Http\Requests\Api\v1\Video\ShowVideo $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video, ShowVideo $request)
    {
        return $video;
    }

    /**
     * Store a newly created video in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Video\StoreVideo $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideo $request)
    {
        $fields = $request->validated();
        $given = $request->file('video');

        return Video::createFromFile($given, $fields);
    }

    /**
     * Update the specified video in storage.
     *
     * @param  \App\Models\Video $video
     * @param  \App\Http\Requests\Api\v1\Video\UpdateVideo $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Video $video, UpdateVideo $request)
    {
        $fields = $request->validated();
        $given = $request->file('video');

        if ($given) {
            $video->updateFromFile($given, $fields);
        } else {
            $video->fill($fields)->save();
        }

        return $video;
    }

    /**
     * Remove the specified video from storage.
     *
     * @param  \App\Models\Video $video
     * @param  \App\Http\Requests\Api\v1\Video\DestroyVideo $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video, DestroyVideo $request)
    {
        $video->delete();
        return response(null, 204);
    }
}
