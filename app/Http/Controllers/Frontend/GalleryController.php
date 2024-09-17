<?php

namespace App\Http\Controllers\Frontend;

use App\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Content::typeGallery()
                            ->published()
                            ->has('gallery')
                            ->orderBy('published_at', 'desc')
                            ->get();
        $data['title'] = "List Gallery";
        $data['galleries'] = $galleries;
        return view('gallery.index_public', $data);
    }

    public function show($id)
    {
        $gallery = Content::typeGallery()
                            ->published()
                            ->whereHas('gallery', function ($query) use ($id)
                            {
                                return $query->where('id', $id);
                            })
                            ->orderBy('published_at', 'desc')
                            ->first()
                            ->gallery;

        $data['title'] = "Gallery";
        $data['gallery'] = $gallery;
        return view('gallery.show', $data);
    }
}
