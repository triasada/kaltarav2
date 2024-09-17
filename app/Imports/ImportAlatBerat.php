<?php

namespace App\Imports;

use App\District;
use App\Inventory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportAlatBerat implements ToCollection
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
                    $inventory = new Inventory();
                    $inventory->inventory_category_id = INVENTORY_CATEGORY_ALAT_BERAT;
                    $inventory->name = $request[0];
                    $inventory->district_id = District::where('name', 'like', $request[1])->first()->id ?? null;
                    $inventory->owner_year = $request[2];
                    $inventory->owner_name = $request[3];
                    $inventory->production_year = $request[4];
                    $inventory->type = $request[5];
                    $inventory->save();
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
