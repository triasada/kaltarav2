<?php

namespace App\Imports;

use App\District;
use App\EducationLevel;
use App\ExpertData;
use App\Jobs;
use App\Qualification;
use App\SkaClassification;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportTenagaKerjaKonstruksi implements ToCollection
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
                    $expertData = new ExpertData();
                    $expertData->name = $request[0];
                    $expertData->id_number = $request[1];
                    $expertData->birth_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($request[2]);
                    $expertData->gender = (isset($request[3]) && $request[3] == 'Perempuan')? 'f':'m';
                    $expertData->jobs_id = Jobs::where('name', $request[4])->first()->id??0;
                    $expertData->address = $request[5];
                    $expertData->district_id = District::where('name', $request[6])->first()->id??0;
                    $expertData->phone_number = $request[7];
                    $expertData->email = $request[8];
                    $expertData->education_level_id = EducationLevel::where('name', $request[9])->first()->id??0;
                    $expertData->ska_classification_id = SkaClassification::where('name', $request[10])->first()->id??0;
                    $expertData->expire_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($request[11]);
                    $expertData->sub_classification_code = $request[12];
                    $expertData->sub_classification_name = $request[13];
                    $expertData->qualification_id = Qualification::where('name', $request[14])->first()->id??0;
                    $expertData->save();
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
