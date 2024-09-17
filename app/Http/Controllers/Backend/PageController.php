<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $this->authorize('View Page', Auth::user());

        $pages = Pages::paginate(10);
        $data['title'] = 'List Pages';
        $data['pages'] = $pages;
        return view('pages.index', $data);
    }

    public function create()
    {
        $this->authorize('Create Page', Auth::user());

        $data['title'] = 'Create Pages';
        return view('pages.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Create Page', Auth::user());

        try
        {
            DB::transaction(function () use ($request)
            {
                $page = new Pages();
                $page->title = $request->title;
                $page->slug = Str::slug($page->title);
                $page->body = $request->body;
                $page->save();
            });
            return redirect()->route('page.index')->withSuccess('Page Created');
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
        $this->authorize('Edit Page', Auth::user());

        $page = Pages::findOrFail($id);
        $data['title'] = 'Edit Pages';
        $data['page'] = $page;
        return view('pages.edit', $data);
    }

    public function update($id, Request $request)
    {
        $this->authorize('Edit Page', Auth::user());

        try
        {
            $page = Pages::findOrFail($id);
            DB::transaction(function () use ($request, $page)
            {
                $page->title = $request->title;
                $page->slug = Str::slug($page->title);
                $page->body = $request->body;
                $page->save();
            });
            return redirect()->route('page.index')->withSuccess('Page Updated');
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
        $this->authorize('Delete Page', Auth::user());
        $page = Pages::findOrFail($id);
        $page->delete();
        return redirect()->route('page.index')->withSuccess('Page Deleted');
    }
}
