<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::paginate(10);
        $data['title'] = 'List Video';
        $data['videos'] = $videos;
        return view('video.index_public', $data);
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);
        $data['video'] = $video;
        $data['title'] = $video->title;
        return view('video.show_public', $data);
    }
}
