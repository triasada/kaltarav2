<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCertification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certification_participant', function (Blueprint $table)
        {
            $table->renameColumn('shool_diploma_path', 'school_diploma_path');
            $table->string('shool_diploma_path')->nullable()->change();
            $table->string('work_experience_path')->nullable()->change();
            $table->string('id_card_path')->nullable()->change();
            $table->string('npwp_path')->nullable()->change();
            $table->string('statement_letter_path')->nullable()->change();
            $table->string('cv_path')->nullable()->change();
            $table->string('photo_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
