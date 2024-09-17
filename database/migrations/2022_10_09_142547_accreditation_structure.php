<?php

use App\AccreditationStructure as AppAccreditationStructure;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AccreditationStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accreditation_structure', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 255);
            $table->timestamps();
        });

        AppAccreditationStructure::create(['name' => 'YA']);
        AppAccreditationStructure::create(['name' => 'TIDAK']);

        Schema::table('association', function (Blueprint $table)
        {
            $table->foreignId('accreditation_structure_id')
                    ->after('orgatization_structure_path')
                    ->nullable()
                    ->constrained('accreditation_structure')
                    ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accreditation_structure');
    }
}
