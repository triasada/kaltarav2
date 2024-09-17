<?php

namespace App\Imports;

use App\School;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportSekolah implements ToCollection
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
                    $school = new School();
                    $school->name = $request[0];
                    $school->city = $request[4];
                    $school->address = $request[1];
                    $school->phone = $request[2];
                    $school->email = $request[3];
                    $school->website = $request[5]? $request[5]:null;
                    $school->save();
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
