<?php

use App\InventoryCategory;
use App\InventoryStatus;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryStatus::create(['name' => 'Baik']);
        InventoryStatus::create(['name' => 'Rusak']);

        InventoryCategory::create(['name' => 'Alat Berat']);
        InventoryCategory::create(['name' => 'Bahan & Material']);
    }
}
