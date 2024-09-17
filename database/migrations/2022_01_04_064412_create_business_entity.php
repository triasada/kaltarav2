<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessEntity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_type', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('business_entity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_type_id')->constrained('business_type')->cascadeOnUpdate();
            $table->string('name');
            $table->string('address');
            $table->foreignId('district_id')->constrained('district')->cascadeOnUpdate();
            $table->string('phone_number');
            $table->string('email');
            $table->string('association');
            $table->string('certified_workers_number');
            $table->string('SKA');
            $table->string('SKT');
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
        Schema::dropIfExists('business_entity');
        Schema::dropIfExists('business_type');
    }
}
