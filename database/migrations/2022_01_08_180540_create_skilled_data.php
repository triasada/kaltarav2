<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkilledData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skt_classification', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('skilled_data', function (Blueprint $table) {
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
            $table->foreignId('skt_classification_id')->constrained('skt_classification')->cascadeOnUpdate();
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
        Schema::dropIfExists('skilled_data');
        Schema::dropIfExists('skt_classification');
    }
}
