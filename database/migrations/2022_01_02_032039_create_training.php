<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraining extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->dateTime('registration_start_date');
            $table->dateTime('registration_end_date');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('is_active')->default(0);
            $table->timestamps();
        });

        Schema::create('training_participant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_id')->constrained('training')->cascadeOnUpdate();
            $table->string('name');
            $table->string('id_number');
            $table->string('birth_date');
            $table->enum('gender', ['m','f']);
            $table->foreignId('jobs_id')->constrained('jobs')->cascadeOnUpdate();
            $table->string('address');
            $table->foreignId('district_id')->constrained('district')->cascadeOnUpdate();
            $table->string('phone_number');
            $table->string('email');
            $table->foreignId('education_level_id')->constrained('education_level')->cascadeOnUpdate();
            $table->enum('certification', ['SKA','SKT'])->nullable();
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
        Schema::dropIfExists('training_participant');
        Schema::dropIfExists('training');
    }
}
