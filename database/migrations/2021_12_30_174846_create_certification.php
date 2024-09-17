<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('registration_start_date');
            $table->dateTime('registration_end_date');
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
        });

        Schema::create('jobs', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('district', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('education_level', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('ska_classification', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('qualification', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('certification_participant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('certification_id')->constrained('certification')->cascadeOnUpdate();
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
            $table->string('shool_diploma_path');
            $table->string('work_experience_path');
            $table->string('id_card_path');
            $table->string('npwp_path');
            $table->string('statement_letter_path');
            $table->string('cv_path');
            $table->string('photo_path');
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
        Schema::dropIfExists('certification_participant');
        Schema::dropIfExists('qualification');
        Schema::dropIfExists('ska_classification');
        Schema::dropIfExists('education_level');
        Schema::dropIfExists('district');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('certification');
    }
}
