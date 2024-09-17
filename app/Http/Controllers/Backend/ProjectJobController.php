<?php

namespace App\Http\Controllers\Backend;

use App\District;
use App\Http\Controllers\Controller;
use App\Imports\ImportProjectJob;
use App\ProjectJob;
use App\ProjectJobContractType;
use App\ProjectJobDesk;
use App\ProjectJobInstantion;
use App\ProjectJobSource;
use App\ProjectJobType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProjectJobController extends Controller
{
    public function index()
    {
        $this->authorize('View Project Job', Auth::user());
        $projectJobs = ProjectJob::get();
        $data['title'] = 'Proyek Pekerjaan';
        $data['projectJobs'] = $projectJobs;
        return view('project_job.index', $data);
    }

    public function create()
    {
        $this->authorize('Create Project Job', Auth::user());
        $contractTypes = ProjectJobContractType::get();
        $jobDesk = ProjectJobDesk::get();
        $jobInstantions = ProjectJobInstantion::get();
        $sources = ProjectJobSource::get();
        $jobTypes = ProjectJobType::get();
        $districts = District::get();

        $data = [
            'title' => 'Tambah Proyek Pekerjaan',
            'contractTypes' => $contractTypes,
            'jobDesks' => $jobDesk,
            'jobInstantions' => $jobInstantions,
            'sources' => $sources,
            'districts' => $districts,
            'jobTypes' => $jobTypes
        ];

        return view('project_job.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Create Project Job', Auth::user());
        try
        {
            DB::transaction(function () use ($request)
            {
                $project = new ProjectJob();
                $project->name = $request->name;
                $project->project_job_type_id = $request->job_type_id;
                $project->project_job_instantion_id = $request->job_instantion_id;
                $project->project_job_desk_id = $request->job_desk_id;
                $project->district_id = $request->district_id;
                $project->year = $request->year;
                $project->project_job_contract_type_id = $request->contract_type_id;
                $project->value = $request->value;
                $project->project_job_source_id = $request->source_id;
                $project->start_date = Carbon::createFromFormat('d-M-Y', $request->start_date);
                $project->end_date = Carbon::createFromFormat('d-M-Y', $request->end_date);
                $project->save();
            });

            return redirect()->route('project.index')->withSuccess('Data Berhasil Disimpan');
        }
        catch (\Throwable $th)
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi kesalahan. Data Gagal Disimpan');
        }
    }

    public function edit($id)
    {
        $this->authorize('Edit Project Job', Auth::user());
        $contractTypes = ProjectJobContractType::get();
        $jobDesk = ProjectJobDesk::get();
        $jobInstantions = ProjectJobInstantion::get();
        $sources = ProjectJobSource::get();
        $jobTypes = ProjectJobType::get();
        $districts = District::get();
        $project = ProjectJob::find($id);
        $data = [
            'title' => 'Edit Proyek Pekerjaan',
            'contractTypes' => $contractTypes,
            'jobDesks' => $jobDesk,
            'jobInstantions' => $jobInstantions,
            'sources' => $sources,
            'districts' => $districts,
            'jobTypes' => $jobTypes,
            'project' => $project
        ];
        return view('project_job.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('Create Project Job', Auth::user());
        try
        {
            $project = ProjectJob::findOrFail($id);
            DB::transaction(function () use ($request, $project)
            {
                $project->name = $request->name;
                $project->project_job_type_id = $request->job_type_id;
                $project->project_job_instantion_id = $request->job_instantion_id;
                $project->project_job_desk_id = $request->job_desk_id;
                $project->district_id = $request->district_id;
                $project->year = $request->year;
                $project->project_job_contract_type_id = $request->contract_type_id;
                $project->value = $request->value;
                $project->project_job_source_id = $request->source_id;
                $project->start_date = Carbon::createFromFormat('d-M-Y', $request->start_date);
                $project->end_date = Carbon::createFromFormat('d-M-Y', $request->end_date);
                $project->save();
            });

            return redirect()->route('project.index')->withSuccess('Data Berhasil Disimpan');
        }
        catch (\Throwable $th)
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi kesalahan. Data Gagal Disimpan');
        }
    }

    public function destroy($id)
    {
        $this->authorize('Delete Project Job', Auth::user());
        try
        {
            $project = ProjectJob::findOrFail($id);
            DB::transaction(function () use ($project)
            {
                $project->delete();
            });
            return redirect()->route('project.index')->withSuccess('Data Berhasil Dihapus');
        }
        catch (\Throwable $th)
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi kesalahan. Data Gagal Dihapus');
        }
    }

    public function import()
    {
        $this->authorize('Create Project Job', Auth::user());

        $data['title'] = 'Import Proyek Pekerjaan';
        return view('project_job.import', $data);
    }

    public function storeImport(Request $request)
    {
        $this->authorize('Create Project Job', Auth::user());
        try
        {
            $template = $request->file_template;
            Excel::import(new ImportProjectJob, $template);
            return redirect()->back()->withSuccess('Import berhasil');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            return redirect()->back()->withErrors($message);
        }
    }
}
