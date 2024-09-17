<?php

namespace App\Http\Controllers\Backend;

use App\District;
use App\EducationLevel;
use App\SkilledData;
use App\Http\Controllers\Controller;
use App\Jobs;
use App\Qualification;
use App\SktClassification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SkilledDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('View ES Data', Auth::user());

        $skilledDatas = SkilledData::paginate(8);
        $data['title'] = 'List Skilled Data';
        $data['skilledDatas'] = $skilledDatas;
        return view('skilled_data.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Create ES Data', Auth::user());
        $jobs = Jobs::get()->pluck('name', 'id');
        $districts = District::get()->pluck('name', 'id');
        $educationLevels = EducationLevel::get()->pluck('name', 'id');
        $sktClassifications = SktClassification::get()->pluck('name', 'id');
        $qualifications = Qualification::get()->pluck('name', 'id');

        $data['title'] = 'Create Skilled Data';
        $data['jobs'] = $jobs;
        $data['districts'] = $districts;
        $data['educationLevels'] = $educationLevels;
        $data['sktClassifications'] = $sktClassifications;
        $data['qualifications'] = $qualifications;
        return view('skilled_data.create', $data);
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
                $skilledData = new SkilledData();
                $skilledData->name = $request->name;
                $skilledData->id_number = $request->nik;
                $skilledData->birth_date = Carbon::createFromFormat('d/m/Y', $request->birth_date);
                $skilledData->gender = $request->gender;
                $skilledData->jobs_id = $request->jobs_id;
                $skilledData->address = $request->address;
                $skilledData->district_id = $request->district_id;
                $skilledData->phone_number = $request->phone_number;
                $skilledData->email = $request->email;
                $skilledData->education_level_id = $request->education_level_id;
                $skilledData->skt_classification_id = $request->skt_classification_id;
                $skilledData->sub_classification_code = $request->sub_classification_code;
                $skilledData->sub_classification_name = $request->sub_classification_name;
                $skilledData->qualification_id = $request->qualification_id;
                $skilledData->save();
            });
            return redirect()->route('skilled-data.index')->withSuccess('Data Saved');
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
        $this->authorize('Edit ES Data', Auth::user());
        $skilledData = SkilledData::findOrFail($id);
        $jobs = Jobs::get()->pluck('name', 'id');
        $districts = District::get()->pluck('name', 'id');
        $educationLevels = EducationLevel::get()->pluck('name', 'id');
        $sktClassifications = SktClassification::get()->pluck('name', 'id');
        $qualifications = Qualification::get()->pluck('name', 'id');

        $data['title'] = 'Edit Skilled Data';
        $data['jobs'] = $jobs;
        $data['skilledData'] = $skilledData;
        $data['districts'] = $districts;
        $data['educationLevels'] = $educationLevels;
        $data['sktClassifications'] = $sktClassifications;
        $data['qualifications'] = $qualifications;
        return view('skilled_data.edit', $data);
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
        $skilledData = SkilledData::findOrFail($id);
        try
        {
            DB::transaction(function () use ($request, $skilledData)
            {
                $skilledData->name = $request->name;
                $skilledData->id_number = $request->nik;
                $skilledData->birth_date = Carbon::createFromFormat('d/m/Y', $request->birth_date);
                $skilledData->gender = $request->gender;
                $skilledData->jobs_id = $request->jobs_id;
                $skilledData->address = $request->address;
                $skilledData->district_id = $request->district_id;
                $skilledData->phone_number = $request->phone_number;
                $skilledData->email = $request->email;
                $skilledData->education_level_id = $request->education_level_id;
                $skilledData->skt_classification_id = $request->skt_classification_id;
                $skilledData->sub_classification_code = $request->sub_classification_code;
                $skilledData->sub_classification_name = $request->sub_classification_name;
                $skilledData->qualification_id = $request->qualification_id;
                $skilledData->save();
            });
            return redirect()->route('skilled-data.index')->withSuccess('Data Saved');
        }
        catch (\Throwable $th)
        {
            dd($th);
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
        $skilledData = SkilledData::findOrFail($id);
        $skilledData->delete();
        return redirect()->route('skilled-data.index')->withSuccess('Data Deleted');
    }
}
