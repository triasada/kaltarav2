<?php

namespace App\Imports;

use App\District;
use App\Inventory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportAlatDanBahan implements ToCollection
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
                    $inventory->inventory_category_id = INVENTORY_CATEGORY_BAHAN_MATERIAL;
                    $inventory->name = $request[0];
                    $inventory->type = $request[4];
                    $inventory->owner_quarry = $request[2];
                    $inventory->status_quarry = $request[3];
                    $inventory->district_id = District::where('name', 'like', $request[1])->first()->id ?? null;
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
