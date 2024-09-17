<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')
                    ->constrained('content')
                    ->cascadeOnUpdate();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('cover_path')->nullable();
            $table->timestamps();
        });

        Schema::create('photo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')
                    ->constrained('content')
                    ->cascadeOnUpdate();
            $table->foreignId('gallery_id')
                    ->constrained('gallery')
                    ->cascadeOnUpdate();
            $table->string('description')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo');
        Schema::dropIfExists('gallery');
    }
}
