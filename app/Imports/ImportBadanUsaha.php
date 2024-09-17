<?php

namespace App\Imports;

use App\Association;
use App\BusinessEntity;
use App\BusinessType;
use App\District;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportBadanUsaha implements ToCollection
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
                    $businessEntity = new BusinessEntity();
                    $businessEntity->business_type_id = BusinessType::where('name', $request[0])->first()->id;
                    $businessEntity->name = $request[1];
                    $businessEntity->address = $request[2];
                    $businessEntity->district_id = District::where('name', $request[3])->first()->id;
                    $businessEntity->phone_number = $request[4]??0;
                    $businessEntity->email = $request[5]??'-';
                    $businessEntity->association_id = Association::where('name', 'like', "%$request[6]%")->first()->id;
                    $businessEntity->certified_workers_number = $request[7]??0;
                    $businessEntity->SKA = $request[8]??0;
                    $businessEntity->SKT = $request[9]??0;
                    $businessEntity->save();
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
