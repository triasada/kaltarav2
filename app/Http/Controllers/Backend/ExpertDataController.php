<?php

namespace App\Http\Controllers\Backend;

use App\District;
use App\EducationLevel;
use App\ExpertData;
use App\Http\Controllers\Controller;
use App\Imports\ImportTenagaKerjaKonstruksi;
use App\Jobs;
use App\Qualification;
use App\SkaClassification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ExpertDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('View ES Data', Auth::user());

        // $expertDatas = ExpertData::paginate(8);
        $expertDatas = ExpertData::get();
        $data['title'] = 'List Tenaga Kerja Konstruksi';
        $data['expertDatas'] = $expertDatas;
        return view('expert_data.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Create ES Data', Auth::user());
        $jobs = Jobs::whereIn('id', [JOB_TENAGA_AHLI_KONSTRUKSI, JOB_TENAGA_TERAMPIL_KONSTRUKSI])->get()->pluck('name', 'id');
        $districts = District::get()->pluck('name', 'id');
        $educationLevels = EducationLevel::get()->pluck('name', 'id');
        $skaClassifications = SkaClassification::get()->pluck('name', 'id');
        $qualifications = Qualification::get()->pluck('name', 'id');

        $data['title'] = 'Tambah Tenaga Kerja Konstruksi';
        $data['jobs'] = $jobs;
        $data['districts'] = $districts;
        $data['educationLevels'] = $educationLevels;
        $data['skaClassifications'] = $skaClassifications;
        $data['qualifications'] = $qualifications;
        return view('expert_data.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Create ES Data', Auth::user());
        try
        {
            DB::transaction(function () use ($request)
            {
                $expertData = new ExpertData();
                $expertData->name = $request->name;
                $expertData->id_number = $request->nik;
                $expertData->birth_date = Carbon::createFromFormat('d/m/Y', $request->birth_date);
                $expertData->gender = $request->gender;
                $expertData->jobs_id = $request->jobs_id;
                $expertData->address = $request->address;
                $expertData->district_id = $request->district_id;
                $expertData->phone_number = $request->phone_number;
                $expertData->email = $request->email;
                $expertData->education_level_id = $request->education_level_id;
                $expertData->ska_classification_id = $request->ska_classification_id;
                $expertData->sub_classification_code = $request->sub_classification_code;
                $expertData->sub_classification_name = $request->sub_classification_name;
                $expertData->qualification_id = $request->qualification_id;
                $expertData->expire_date = Carbon::createFromFormat('d/m/Y', $request->expire_date);
                $expertData->save();
            });
            return redirect()->route('expert-data.index')->withSuccess('Data Saved');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors('Terjadi kesalahan. silahkan kontak admin');
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
        $this->authorize('Edit Tenaga Kerja Konstruksi', Auth::user());
        $expertData = ExpertData::findOrFail($id);
        $jobs = Jobs::whereIn('id', [JOB_TENAGA_AHLI_KONSTRUKSI, JOB_TENAGA_TERAMPIL_KONSTRUKSI])->get()->pluck('name', 'id');
        $districts = District::get()->pluck('name', 'id');
        $educationLevels = EducationLevel::get()->pluck('name', 'id');
        $skaClassifications = SkaClassification::get()->pluck('name', 'id');
        $qualifications = Qualification::get()->pluck('name', 'id');

        $data['title'] = 'Ubah Expert Data';
        $data['jobs'] = $jobs;
        $data['expertData'] = $expertData;
        $data['districts'] = $districts;
        $data['educationLevels'] = $educationLevels;
        $data['skaClassifications'] = $skaClassifications;
        $data['qualifications'] = $qualifications;
        return view('expert_data.edit', $data);
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
        $this->authorize('Edit ES Data', Auth::user());
        $expertData = ExpertData::findOrFail($id);
        try
        {
            DB::transaction(function () use ($request, $expertData)
            {
                $expertData->name = $request->name;
                $expertData->id_number = $request->nik;
                $expertData->birth_date = Carbon::createFromFormat('d/m/Y', $request->birth_date);
                $expertData->gender = $request->gender;
                $expertData->jobs_id = $request->jobs_id;
                $expertData->address = $request->address;
                $expertData->district_id = $request->district_id;
                $expertData->phone_number = $request->phone_number;
                $expertData->email = $request->email;
                $expertData->education_level_id = $request->education_level_id;
                $expertData->ska_classification_id = $request->ska_classification_id;
                $expertData->sub_classification_code = $request->sub_classification_code;
                $expertData->sub_classification_name = $request->sub_classification_name;
                $expertData->qualification_id = $request->qualification_id;
                $expertData->expire_date = Carbon::createFromFormat('d/m/Y', $request->expire_date);
                $expertData->save();
            });
            return redirect()->route('expert-data.index')->withSuccess('Data Saved');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors('Terjadi kesalahan. silahkan kontak admin');
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
        $this->authorize('Delete ES Data', Auth::user());
        $expertData = ExpertData::findOrFail($id);
        $expertData->delete();
        return redirect()->route('expert-data.index')->withSuccess('Data Deleted');
    }

    public function import()
    {
        $this->authorize('Create ES Data', Auth::user());

        $data['title'] = 'Import Tenaga Kerja Konstruksi';
        return view('expert_data.import', $data);
    }

    public function storeImport(Request $request)
    {
        $this->authorize('Create ES Data', Auth::user());
        try
        {
            $template = $request->file_template;
            Excel::import(new ImportTenagaKerjaKonstruksi, $template);
            return redirect()->back()->withSuccess('Importe berhasil');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            return redirect()->back()->withErrors($message);
        }
    }
}
