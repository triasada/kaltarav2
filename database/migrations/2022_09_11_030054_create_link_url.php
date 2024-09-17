<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateLinkUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_url', function (Blueprint $table) {
            $table->id();
            $table->string('name', '200');
            $table->string('url', '500')->nullable();
            $table->timestamps();
        });

        Artisan::call('db:seed  --class=LinkUrlSeeder');
        Artisan::call('add:permission "View Link Url" "Link Url"');
        Artisan::call('add:permission "Create Link Url" "Link Url"');
        Artisan::call('add:permission "Edit Link Url" "Link Url"');
        Artisan::call('add:permission "Delete Link Url" "Link Url"');
        Artisan::call('config:cache');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_url');
    }
}
