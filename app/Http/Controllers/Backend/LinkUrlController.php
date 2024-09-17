<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\LinkUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LinkUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('View Link Url', Auth::user());
        $links = LinkUrl::get();
        $data['links'] = $links;
        $data['title'] = 'Link Terkait';
        return view('link.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Link Url';
        return view('link.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            DB::transaction(function () use ($request)
            {
                $link = LinkUrl::create(
                    ['name' => $request->name, 'url' => $request->url??null]
                );
            });
            return redirect()->route('link-url.index')->withSuccess('Data berhasil disimpan');
        } 
        catch (\Throwable $th) 
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi Kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = LinkUrl::findOrFail($id);
        $data['link'] = $link;
        $data['title'] = 'Edit Link Url';
        return view('link.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try 
        {
            $link = LinkUrl::findOrFail($id);
            DB::transaction(function () use ($request, $link)
            {
                $link->name = $request->name;
                $link->url = $request->url??null;
                $link->save();
            });
            return redirect()->route('link-url.index')->withSuccess('Data berhasil disimpan');
        } 
        catch (\Throwable $th) 
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi Kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try 
        {
            $link = LinkUrl::findOrFail($id);
            DB::transaction(function () use ($link)
            {
                $link->delete();
            });
            return redirect()->route('link-url.index')->withSuccess('Data berhasil dihapus');
        } 
        catch (\Throwable $th) 
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi Kesalahan');
        }
    }
}
