<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory', function (Blueprint $table) {
            $table->string('type', 255)->nullable()->after('description');
            $table->string('production_year', 255)->nullable()->after('description');
            $table->string('owner_name', 255)->nullable()->after('description');
            $table->string('owner_year', 255)->nullable()->after('description');
            $table->string('owner_quarry', 255)->nullable()->after('description');
            $table->string('status_quarry', 255)->nullable()->after('description');
            $table->foreignId('district_id')
                    ->after('description')
                    ->nullable()
                    ->constrained('district')
                    ->cascadeOnUpdate()
                    ->restrictOndelete();
        });

        // InventoryLocation::
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory', function (Blueprint $table) {
            //
        });
    }
}
