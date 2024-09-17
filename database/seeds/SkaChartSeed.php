<?php

use App\SkaClassification;
use Illuminate\Database\Seeder;

class SkaChartSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SkaClassification::get()
                        ->each(function ($ska)
                        {
                            $ska->chart_background = "rgba(".rand(0,255).", ".rand(0,255).", ".rand(0,255).", 0.7)";
                            $ska->save();
                        });
    }
}
