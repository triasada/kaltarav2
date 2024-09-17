<?php

namespace App\Http\Controllers\Backend;

use App\Content;
use App\Gallery;
use App\Http\Controllers\Controller;
use App\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Null_;

class GalleryController extends Controller
{
    public function index()
    {
        $this->authorize('View Gallery', Auth::user());
        $galleries = Gallery::whereHas('content', function ($query)
                            {
                                return $query->notDeleted();
                            })
                            ->orderBy('created_at', 'desc')
                            ->paginate(8);
        $data['title'] = 'List Gallery';
        $data['galleries'] = $galleries;
        return view('gallery.index', $data);
    }

    public function create()
    {
        $this->authorize('Create Gallery', Auth::user());
        $data['title'] = 'Add Gallery';
        return view('gallery.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Create Gallery', Auth::user());
        try
        {
            DB::transaction(function () use($request)
            {
                $content = new Content();
                $content->content_type_id = CONTENT_TYPE_GALLERY;
                $content->content_status_id = CONTENT_STATUS_PUBLISHED;
                $content->published_at = Carbon::now();
                $content->save();

                $gallery = new Gallery();
                $gallery->content_id = $content->id;
                $gallery->title = $request->title;
                $gallery->description = $request->description;
                $gallery->save();

                foreach ($request->photo as $file)
                {
                    $content = new Content();
                    $content->content_type_id = CONTENT_TYPE_PHOTO;
                    $content->content_status_id = CONTENT_STATUS_PUBLISHED;
                    $content->published_at = Carbon::now();
                    $content->save();

                    $photo = new Photo();
                    $photo->content_id = $content->id;
                    $photo->gallery_id = $gallery->id;
                    $photo->save();

                    if ($file)
                    {
                        $config['disk'] = 'upload';
                        $config['upload_path'] = '/gallery/'.$gallery->id.'/photo';
                        $config['public_path'] = env('APP_URL') . '/upload/gallery/'.$gallery->id.'/photo';

                        // create directory if doesn't exist
                        if (!Storage::disk($config['disk'])->has($config['upload_path']))
                        {
                            Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                        }

                        // upload file if valid
                        if ($file->isValid())
                        {
                            $filename = uniqid() .'.'. $file->getClientOriginalExtension();

                            Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);
                            $photo->image_path = $config['disk'].$config['upload_path'].'/'.$filename;

                            $photo->save();
                        }
                    }
                }

                $firstPhoto = $gallery->photos->first();
                if($firstPhoto)
                {
                    $gallery->cover_path = $firstPhoto->image_path;
                    $gallery->save();
                }
            });

            return redirect()->route('gallery.index')->withSuccess('Create gallery success');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
        }
    }

    
    public function edit($id)
    {
        $this->authorize('Edit Gallery', Auth::user());

        $gallery = Gallery::with('photos', 'content')
                            ->whereHas('content', function ($query)
                            {
                                return $query->notDeleted();
                            })
                            ->find($id);

        if(is_null($gallery))
        {
            return redirect()->back()->withErrors('Gallery not found');
        }

        $data['title'] = 'Edit Gallery';
        $data['gallery'] = $gallery;
        $data['photos'] = $gallery->photos;
        Log::info(public_path('upload'));
        return view('gallery.edit', $data);
    }

    public function update($id, Request $request)
    {
        $this->authorize('Edit Gallery', Auth::user());
        try
        {
            $gallery = Gallery::findOrFail($id);
            DB::transaction(function () use ($request, $gallery)
            {
                $gallery->title = $request->title;
                $gallery->description = $request->description;
                $gallery->save();
    
                $photos = $gallery->photos;
                if ($request->photo)
                {
                    foreach ($request->photo as $key => $file)
                    {
                        // update
                        if(isset($photos[$key]))
                        {
                            $photo = $photos[$key];
                            if ($file)
                            {
                                $config['disk'] = 'upload';
                                $config['upload_path'] = '/gallery/'.$gallery->id.'/photo';
                                $config['public_path'] = env('APP_URL') . '/upload/gallery/'.$gallery->id.'/photo';
            
                                // create directory if doesn't exist
                                if (!Storage::disk($config['disk'])->has($config['upload_path']))
                                {
                                    Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                                }
            
                                // upload file if valid
                                if ($file->isValid())
                                {
                                    $filename = uniqid() .'.'. $file->getClientOriginalExtension();
            
                                    Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);
                                    $photo->image_path = $config['disk'].$config['upload_path'].'/'.$filename;
            
                                    $photo->save();
                                }
                            }
                        }
                        // create new
                        else
                        {
                            $content = new Content();
                            $content->content_type_id = CONTENT_TYPE_PHOTO;
                            $content->content_status_id = CONTENT_STATUS_PUBLISHED;
                            $content->published_at = Carbon::now();
                            $content->save();
            
                            $photo = new Photo();
                            $photo->content_id = $content->id;
                            $photo->gallery_id = $gallery->id;
                            $photo->save();
            
                            if ($file)
                            {
                                $config['disk'] = 'upload';
                                $config['upload_path'] = '/gallery/'.$gallery->id.'/photo';
                                $config['public_path'] = env('APP_URL') . '/upload/gallery/'.$gallery->id.'/photo';
            
                                // create directory if doesn't exist
                                if (!Storage::disk($config['disk'])->has($config['upload_path']))
                                {
                                    Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                                }
            
                                // upload file if valid
                                if ($file->isValid())
                                {
                                    $filename = uniqid() .'.'. $file->getClientOriginalExtension();
            
                                    Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);
                                    $photo->image_path = $config['disk'].$config['upload_path'].'/'.$filename;
            
                                    $photo->save();
                                }
                            }
                        }
                    }
        
                    $firstPhoto = $gallery->photos->first();
                    if($firstPhoto)
                    {
                        $gallery->cover_path = $firstPhoto->image_path;
                        $gallery->save();
                    }
                }
            });
            return redirect()->route('gallery.index')->withSuccess('Update gallery success');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
        }
    }

    public function destroy($id)
    {
        try
        {
            $gallery = Gallery::with('photos', 'content')
                                ->whereHas('content', function ($query)
                                {
                                    return $query->notDeleted();
                                })
                                ->find($id);

            $content = $gallery->content;
            $content->content_status_id = CONTENT_STATUS_DELETED;
            $content->save();
            
            return redirect()->route('gallery.index')->withSuccess('Delete gallery success');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
        }
    }
}
