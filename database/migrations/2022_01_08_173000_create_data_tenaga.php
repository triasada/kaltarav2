<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTenaga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('id_number');
            $table->date('birth_date');
            $table->enum('gender', ['m','f']);
            $table->foreignId('jobs_id')->constrained('jobs')->cascadeOnUpdate();
            $table->string('address');
            $table->foreignId('district_id')->constrained('district')->cascadeOnUpdate();
            $table->string('phone_number');
            $table->string('email');
            $table->foreignId('education_level_id')->constrained('education_level')->cascadeOnUpdate();
            $table->foreignId('ska_classification_id')->constrained('ska_classification')->cascadeOnUpdate();
            $table->string('sub_classification_code');
            $table->string('sub_classification_name');
            $table->foreignId('qualification_id')->constrained('qualification')->cascadeOnUpdate();
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
        Schema::dropIfExists('expert_data');
    }
}
