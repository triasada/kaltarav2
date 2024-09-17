<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:role {rolename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add role. Use double quotes for role names that are more than 1 word';

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
        Role::create(['name' => $this->argument('rolename')]);
        echo "added role ".$this->argument('rolename');
    }
}
