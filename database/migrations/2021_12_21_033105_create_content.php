<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        
        Schema::create('content_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_type_id')
                    ->constrained('content_type')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
            $table->foreignId('content_status_id')
                    ->constrained('content_status')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
            $table->integer('views')->default(0);
            $table->dateTime('published_at');
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
        Schema::dropIfExists('content');
        Schema::dropIfExists('content_status');
        Schema::dropIfExists('content_type');
    }
}
