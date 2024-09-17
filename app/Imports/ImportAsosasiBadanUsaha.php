<?php

namespace App\Imports;

use App\AccreditationStructure;
use App\Association;
use App\District;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportAsosasiBadanUsaha implements ToCollection
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
                    $formedDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($request[1]);
                    $asociationTypeId = 1;
                    $association = new Association();
                    $association->name = $request[0];
                    $association->formed_date = $formedDate;
                    $association->association_type_id = $asociationTypeId;
                    $association->address = $request[3];
                    $association->district_id = District::where('name', $request[4])->first()->id;
                    $association->phone_number = $request[5];
                    $association->email = $request[6]??'-';
                    if($request[7])
                        $association->contact_person_name = $request[7];
                    if($request[8])
                        $association->contact_person_number = $request[8];
                    $association->member_number = $request[9];
                    $association->accreditation_structure_id = AccreditationStructure::where('name', $request[10])->first()->id;
                    $association->save();
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
