<?php

namespace App\Http\Controllers\Backend;

use App\CertificationType;
use App\District;
use App\Http\Controllers\Controller;
use App\JobSeeker;
use App\JobSeekerJobType;
use App\JobSeekerSchoolLevel;
use App\Qualification;
use App\SkaClassification;
use App\SktClassification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JobSeekerController extends Controller
{
    public function index()
    {
        $this->authorize('View Job Seeker', Auth::user());
        $jobSeekers = JobSeeker::get();
        $data['title'] = 'Pencari Kerja';
        $data['jobSeekers'] = $jobSeekers;
        return view('job_seeker.index', $data);
    }

    public function create()
    {
        $this->authorize('Create Job Seeker', Auth::user());
        $data['title'] = 'Tambah Pencari Kerja';
        $data['certificationTypes'] = CertificationType::get();
        $data['ska'] = SkaClassification::get();
        $data['skt'] = SktClassification::get();
        $data['jobTypes'] = JobSeekerJobType::get();
        $data['schoolLevels'] = JobSeekerSchoolLevel::get();
        $data['districts'] = District::get();
        $data['qualifications'] = Qualification::get();
        return view('job_seeker.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Create Job Seeker', Auth::user());
        try
        {
            DB::transaction(function () use ($request)
            {
                $jobSeeker = new JobSeeker();
                $jobSeeker->name = $request->name;
                $jobSeeker->id_number = $request->id_number;
                $jobSeeker->birth_date = Carbon::createFromFormat('d-M-Y', $request->birth_date);
                $jobSeeker->gender = $request->gender;
                $jobSeeker->job_seeker_job_type_id = $request->job_seeker_job_type_id;
                $jobSeeker->district_id = $request->district_id;
                $jobSeeker->address = $request->address;
                $jobSeeker->phone_number = $request->phone_number;
                $jobSeeker->email = $request->email;
                $jobSeeker->job_seeker_school_level_id = $request->job_seeker_school_level_id;
                $jobSeeker->certification_type_id = $request->certification_type_id;
                $jobSeeker->class_certification_type_id = $request->class_certification_type_id;
                $jobSeeker->sub_classification_code = $request->sub_classification_code;
                $jobSeeker->sub_classification_name = $request->sub_classification_name;
                $jobSeeker->qualification_id = $request->qualification_id;
                $jobSeeker->save();
            });

            return redirect()->route('job-seeker.index')->withSuccess('Data Berhasil Disimpan');
        }
        catch (\Throwable $th)
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi kesalahan. Data Gagal Disimpan');
        }
    }

    public function edit($id)
    {
        $this->authorize('Edit Job Seeker', Auth::user());
        $data['title'] = 'Tambah Pencari Kerja';
        $data['certificationTypes'] = CertificationType::get();
        $data['ska'] = SkaClassification::get();
        $data['skt'] = SktClassification::get();
        $data['jobTypes'] = JobSeekerJobType::get();
        $data['schoolLevels'] = JobSeekerSchoolLevel::get();
        $data['districts'] = District::get();
        $data['qualifications'] = Qualification::get();
        $data['jobSeeker'] = JobSeeker::findOrFail($id);
        return view('job_seeker.edit', $data);
    }

    public function update($id, Request $request)
    {
        $this->authorize('Edit Job Seeker', Auth::user());
        try
        {
            $jobSeeker = JobSeeker::findOrFail($id);
            DB::transaction(function () use ($request, $jobSeeker)
            {
                $jobSeeker->name = $request->name;
                $jobSeeker->id_number = $request->id_number;
                $jobSeeker->birth_date = Carbon::createFromFormat('d-M-Y', $request->birth_date);
                $jobSeeker->gender = $request->gender;
                $jobSeeker->job_seeker_job_type_id = $request->job_seeker_job_type_id;
                $jobSeeker->district_id = $request->district_id;
                $jobSeeker->address = $request->address;
                $jobSeeker->phone_number = $request->phone_number;
                $jobSeeker->email = $request->email;
                $jobSeeker->job_seeker_school_level_id = $request->job_seeker_school_level_id;
                $jobSeeker->certification_type_id = $request->certification_type_id;
                $jobSeeker->class_certification_type_id = $request->class_certification_type_id;
                $jobSeeker->sub_classification_code = $request->sub_classification_code;
                $jobSeeker->sub_classification_name = $request->sub_classification_name;
                $jobSeeker->qualification_id = $request->qualification_id;
                $jobSeeker->save();
            });

            return redirect()->route('job-seeker.index')->withSuccess('Data Berhasil Disimpan');
        }
        catch (\Throwable $th)
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi kesalahan. Data Gagal Disimpan');
        }
    }

    public function destroy($id)
    {
        $this->authorize('Delete Job Seeker', Auth::user());
        try
        {
            $jobSeeker = JobSeeker::findOrFail($id);
            DB::transaction(function () use ($jobSeeker)
            {
                $jobSeeker->delete();
            });
            return redirect()->route('job-seeker.index')->withSuccess('Data Berhasil Dihapus');
        }
        catch (\Throwable $th)
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi kesalahan. Data Gagal Dihapus');
        }
    }
}
