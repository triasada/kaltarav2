<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\SchoolLevel;
use App\SchoolMajor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchoolMajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('View Jurusan', Auth::user());
        $majors = SchoolMajor::get();
        $data = [
            'title' => 'List Jurusan',
            'majors' => $majors
        ];

        return view('school_major.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Create Jurusan', Auth::user());
        $schoolLevels = SchoolLevel::get();
        $data = [
            'title' => 'Tambah Jurusan',
            'schoolLevels' => $schoolLevels
        ];

        return view('school_major.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Create Jurusan', Auth::user());
        try
        {
            DB::transaction(function () use ($request)
            {
                $major = new SchoolMajor();
                $major->name = $request->name;
                $major->school_level_id = $request->school_level_id;
                $major->save();
            });
            return redirect()->route('school-major.index')->withSuccess('Berhasil Menyimpan Data');
        }
        catch (\Throwable $th)
        {
            return redirect()->back()->withErrors('Gagal Menyimpan Data');
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
        $this->authorize('Edit Jurusan', Auth::user());
        $major = SchoolMajor::findOrFail($id);
        $schoolLevels = SchoolLevel::get();
        $data = [
            'title' => 'Edit Jurusan',
            'schoolLevels' => $schoolLevels,
            'major' => $major
        ];

        return view('school_major.edit', $data);
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
        $this->authorize('Edit Jurusan', Auth::user());
        try
        {
            $major = SchoolMajor::findOrFail($id);
            DB::transaction(function () use ($request, $major)
            {
                $major->name = $request->name;
                $major->school_level_id = $request->school_level_id;
                $major->save();
            });
            return redirect()->route('school-major.index')->withSuccess('Berhasil Menyimpan Data');
        }
        catch (\Throwable $th)
        {
            return redirect()->back()->withErrors('Gagal Menyimpan Data');
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
        $this->authorize('Delete Jurusan', Auth::user());
        try
        {
            $major = SchoolMajor::findOrFail($id);
            DB::transaction(function () use ($major)
            {
                $major->delete();
            });
            return redirect()->route('school-major.index')->withSuccess('Berhasil Menghapus Data');
        }
        catch (\Throwable $th)
        {
            return redirect()->back()->withErrors('Gagal Menghapus Data');
        }
    }
}
