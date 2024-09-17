<?php

namespace App\Imports;

use App\District;
use App\ProjectJob;
use App\ProjectJobContractType;
use App\ProjectJobDesk;
use App\ProjectJobInstantion;
use App\ProjectJobSource;
use App\ProjectJobType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportProjectJob implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $value)
        {
            if($key == 0)
            {
                continue;
            }

            $request = $value;
            try
            {
                DB::transaction(function () use ($request)
                {
                    $project = new ProjectJob();
                    $project->name = $request[0];
                    $project->project_job_type_id = ProjectJobType::where('name', $request[1])->first()->id??null;
                    $project->project_job_instantion_id = ProjectJobInstantion::where('name', $request[2])->first()->id??null;
                    $project->project_job_desk_id = ProjectJobDesk::where('name', $request[3])->first()->id??null;
                    $project->district_id = District::where('name', $request[4])->first()->id??null;
                    $project->year = $request[5];
                    $project->project_job_contract_type_id = ProjectJobContractType::where('name', $request[6])->first()->id??null;
                    $project->start_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($request[7]);
                    $project->end_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($request[8]);
                    $project->value = $request[9];
                    $project->project_job_source_id = ProjectJobSource::where('name', $request[10])->first()->id??null;
                    $project->save();
                });
            }
            catch (\Throwable $th)
            {
                Log::error($th);
                continue;
            }
        }
    }
}
