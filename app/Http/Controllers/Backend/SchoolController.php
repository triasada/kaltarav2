<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\ImportSekolah;
use App\School;
use App\SchoolLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class SchoolController extends Controller
{
    public function index()
    {
        $this->authorize('View School', Auth::user());
        $schools = School::get();
        $data['title'] = 'Perguruan Tinggi / Sekolah';
        $data['schools'] = $schools;
        return view('school.index', $data);
    }

    public function create()
    {
        $this->authorize('Create School', Auth::user());
        $data['title'] = 'Tambah Perguruan Tinggi / Sekolah';
        $data['schoolLevels'] = SchoolLevel::with('schoolMajors')->get();
        return view('school.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Create School', Auth::user());
        try
        {
            DB::transaction(function () use ($request)
            {
                $school = new School();
                $school->name = $request->name;
                // $school->school_level_id = $request->school_level_id;
                // $school->school_major_id = $request->school_major_id;
                $school->city = $request->city;
                $school->address = $request->address;
                $school->phone = $request->phone;
                $school->email = $request->email;
                // $school->graduate_amount_man = $request->graduate_amount_man;
                // $school->graduate_amount_female = $request->graduate_amount_female;
                // $school->graduate_amount_total = $request->graduate_amount_total;
                $school->website = $request->website? $request->website:null;
                $school->save();
            });

            return redirect()->route('school.index')->withSuccess('Data Berhasil Disimpan');
        }
        catch (\Throwable $th)
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi kesalahan. Data Gagal Disimpan');
        }
    }

    public function edit($id)
    {
        $this->authorize('Edit School', Auth::user());
        $data['title'] = 'Edit Perguruan Tinggi / Sekolah';
        $data['schoolLevels'] = SchoolLevel::with('schoolMajors')->get();
        $data['school'] = School::findOrFail($id);
        return view('school.edit', $data);
    }

    public function update($id, Request $request)
    {
        $this->authorize('Edit School', Auth::user());
        try
        {
            $school = School::findOrFail($id);
            DB::transaction(function () use ($request, $school)
            {
                $school->name = $request->name;
                // $school->school_level_id = $request->school_level_id;
                // $school->school_major_id = $request->school_major_id;
                $school->city = $request->city;
                $school->address = $request->address;
                $school->phone = $request->phone;
                $school->email = $request->email;
                // $school->graduate_amount_man = $request->graduate_amount_man;
                // $school->graduate_amount_female = $request->graduate_amount_female;
                // $school->graduate_amount_total = $request->graduate_amount_total;
                $school->website = $request->website? $request->website:null;
                $school->save();
            });

            return redirect()->route('school.index')->withSuccess('Data Berhasil Disimpan');
        }
        catch (\Throwable $th)
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi kesalahan. Data Gagal Disimpan');
        }
    }

    public function destroy($id)
    {
        $this->authorize('Delete School', Auth::user());
        try
        {
            $school = School::findOrFail($id);
            DB::transaction(function () use ($school)
            {
                $school->delete();
            });
            return redirect()->route('school.index')->withSuccess('Data Berhasil Dihapus');
        }
        catch (\Throwable $th)
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi kesalahan. Data Gagal Dihapus');
        }
    }

    public function import()
    {
        $this->authorize('Create School', Auth::user());

        $data['title'] = 'Import Sekolah';
        return view('school.import', $data);
    }

    public function storeImport(Request $request)
    {
        $this->authorize('Create School', Auth::user());
        try
        {
            $template = $request->file_template;
            Excel::import(new ImportSekolah, $template);
            return redirect()->back()->withSuccess('Import berhasil');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            return redirect()->back()->withErrors($message);
        }
    }
}
