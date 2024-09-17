<?php

namespace App\Console\Commands;

use App\ExpertData;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SetExpireExpertData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setexpire:expertdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        ExpertData::where('expire_date', '>', $now)
                    ->where('is_active', 1)
                    ->get()
                    ->each(function ($data)
                    {
                        $data->is_active = 0;
                        $data->save();
                    });
    }
}
