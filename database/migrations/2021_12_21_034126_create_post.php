<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')
                ->constrained('content')
                ->cascadeOnUpdate();
            $table->foreignId('creator_id')
                    ->constrained('users')
                    ->cascadeOnUpdate();
            $table->string('title');
            $table->string('excerpt')->nullable();
            $table->text('body')->nullable();
            $table->string('featured_image_path')->nullable();
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
        Schema::dropIfExists('post');
    }
}
