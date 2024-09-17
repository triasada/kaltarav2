<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Pages;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($id, $slug = null)
    {
        $page = Pages::findOrFail($id);
        if($page->slug != $slug)
        {
            return redirect()->route('page.read', [$page->id, $page->slug]);
        }

        $data['title'] = $page->title;
        $data['page'] = $page;
        return view('pages.read', $data);
    }
}
