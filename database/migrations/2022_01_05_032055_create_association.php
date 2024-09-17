<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('association', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('formed_date');
            $table->foreignId('association_type_id')->constrained('association_type')->cascadeOnUpdate();
            $table->string('address');
            $table->foreignId('district_id')->constrained('district')->cascadeOnUpdate();
            $table->string('phone_number');
            $table->string('email');
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_number')->nullable();
            $table->integer('member_number');
            $table->string('orgatization_structure_path')->nullable();
            $table->timestamps();
        });

        Schema::table('business_entity', function (Blueprint $table)
        {
            $table->dropColumn('association');
            $table->foreignId('association_id')->after('email')->constrained('association')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_entity', function (Blueprint $table)
        {
            $table->dropForeign('business_entity_association_id_foreign');
            $table->dropColumn('association_id');
            $table->string('association')->after('email');
        });
        Schema::dropIfExists('association');
        Schema::dropIfExists('association_type');
    }
}
