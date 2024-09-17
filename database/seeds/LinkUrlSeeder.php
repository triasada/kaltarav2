<?php

use App\LinkUrl;
use Illuminate\Database\Seeder;

class LinkUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LinkUrl::create(['name' => 'OSS']);
        LinkUrl::create(['name' => 'LPJK']);
        LinkUrl::create(['name' => 'SIPJAKI']);
    }
}
