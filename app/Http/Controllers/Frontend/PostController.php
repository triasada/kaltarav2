<?php

namespace App\Http\Controllers\Frontend;

use App\Content;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $contentPosts = Content::typePost()
                                ->published()
                                ->whereHas('post', function ($query)
                                {
                                    return $query->categoryNews();
                                })
                                ->orderBy('published_at', 'desc')
                                ->paginate(9);

        $data['title'] = 'Berita Terbaru';
        $data['contentPosts'] = $contentPosts;
        return view('posts.index_public', $data);
    }

    public function indexAnnouncement()
    {
        $contentPosts = Content::typePost()
                                ->published()
                                ->whereHas('post', function ($query)
                                {
                                    return $query->categoryAnnouncement();
                                })
                                ->orderBy('published_at', 'desc')
                                ->paginate(9);

        $data['title'] = 'Pengumuman';
        $data['contentPosts'] = $contentPosts;
        return view('posts.announcement', $data);
    }

    public function show($id, $slug = null)
    {
        $post = Post::findOrFail($id);
        if($post->slug != $slug)
        {
            return redirect()->route('post.read', [$post->id, $post->slug]);
        }

        $otherPost = Content::typePost()
                            ->published()
                            ->has('post')
                            ->whereNotIn('id', [$post->id])
                            ->orderBy('published_at', 'desc')
                            ->take(5)
                            ->get();
        
        $data['title'] = $post->title;
        $data['post'] = $post;
        $data['otherPost'] = $otherPost;
        return view('posts.read', $data);
    }
}
