<?php

namespace App\Http\Controllers\Backend;

use App\Content;
use App\Http\Controllers\Controller;
use App\Post;
use App\PostCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $this->authorize('View Post', Auth::user());
        $posts = Post::whereHas('content', function ($query)
                        {
                            return $query->notDeleted();
                        })
                        ->orderBy('created_at', 'desc')
                        ->paginate(7);
        $data['title'] = 'List Post';
        $data['posts'] = $posts;

        return view('posts.index', $data);
    }

    public function create()
    {
        $this->authorize('Create Post', Auth::user());

        $postCategories = PostCategory::get()->pluck('name', 'id');
        $data['title'] = 'Create Post';
        $data['postCategories'] = $postCategories;
        return view('posts.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Create Post', Auth::user());
        try
        {
            DB::transaction(function () use ($request)
            {
                // create content
                $content = new Content();
                $content->content_type_id = CONTENT_TYPE_POST;
                $content->content_status_id = CONTENT_STATUS_PUBLISHED;
                $content->published_at = Carbon::now();
                $content->save();

                // create post
                $post = new Post();
                $post->post_category_id = $request->post_category_id;
                $post->content_id = $content->id;
                $post->creator_id = Auth::user()->id;
                $post->title = $request->title;
                $post->slug = Str::slug($post->title);
                $post->excerpt = $request->excerpt;
                $post->body = $request->body;
                $post->featured_image_path = parse_url($request->thumbnail)['path'];
                $post->save();
            });

            return redirect()->route('post.index')->withSuccess('Post Published');
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
        $this->authorize('Edit Post', Auth::user());

        $post = Post::whereHas('content', function ($query)
                    {
                        return $query->notDeleted();
                    })
                    ->find($id);
        if(is_null($post))
        {
            return redirect()->back()->withErrors('Post not found');
        }
        $data['title'] = 'Edit Post';
        $data['post'] = $post;
        return view('posts.edit', $data);
    }

    public function update($id, Request $request)
    {
        $this->authorize('Edit Post', Auth::user());
        try
        {
            $post = Post::find($id);
            if(is_null($post))
            {
                return redirect()->back()->withErrors('Post not found');
            }

            $content = $post->content;
            if(is_null($content))
            {
                $content = new Content();
                $content->content_type_id = CONTENT_TYPE_POST;
                $content->content_status_id = CONTENT_STATUS_PUBLISHED;
                $content->published_at = $post->created_at;
                $content->save();
            }

            DB::transaction(function () use ($request, $post, $content)
            {
                // edit content
                /*$content->content_status_id = CONTENT_STATUS_PUBLISHED;
                $content->published_at = Carbon::now();
                $content->save();*/

                // edit post
                $post->content_id = $content->id;
                $post->creator_id = Auth::user()->id;
                $post->title = $request->title;
                $post->slug = Str::slug($post->title);
                $post->excerpt = $request->excerpt;
                $post->body = $request->body;
                $post->featured_image_path = parse_url($request->thumbnail)['path'];
                $post->save();
            });

            return redirect()->route('post.index')->withSuccess('Post Published');
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
        $this->authorize('Delete Post', Auth::user());
        $post = Post::whereHas('content', function ($query)
                    {
                        return $query->notDeleted();
                    })
                    ->find($id);
        if(is_null($post))
        {
            return redirect()->back()->withErrors('Post not found');
        }

        $content = $post->content;
        if(is_null($content))
        {
            $content = new Content();
            $content->content_type_id = CONTENT_TYPE_POST;
            $content->content_status_id = CONTENT_STATUS_DELETED;
            $content->published_at = $post->created_at;
            $content->save();

            return redirect()->route('post.index')->withSuccess('Post Deleted');
        }
        
        $content->content_status_id = CONTENT_STATUS_DELETED;
        $content->save();
        return redirect()->route('post.index')->withSuccess('Post Deleted');
    }
}
