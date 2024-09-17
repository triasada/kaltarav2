<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class InventoryModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_category', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->timestamps();
        });
        Schema::create('inventory_status', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->timestamps();
        });
        Schema::create('inventory', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('inventory_category_id')
                    ->constrained('inventory_category')
                    ->cascadeOnUpdate();
            $table->string('name', 250)->nullable();
            $table->string('img_path', 500)->nullable();
            $table->integer('amount')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
        Schema::create('inventory_inventory_status', function (Blueprint $table)
        {
            $table->foreignId('inventory_id')
                    ->constrained('inventory')
                    ->cascadeOnUpdate();
            $table->foreignId('inventory_status_id')
                    ->constrained('inventory_status')
                    ->cascadeOnUpdate();
            $table->integer('amount')->default(0);
        });

        // Artisan::call('dump-autoload');
        // system('composer dump-autoload');
        Artisan::call('db:seed', array('--class' => 'InventorySeeder'));
        Artisan::call('add:permission "View Inventory" "Inventory"');
        Artisan::call('add:permission "Create Inventory" "Inventory"');
        Artisan::call('add:permission "Edit Inventory" "Inventory"');
        Artisan::call('add:permission "Delete Inventory" "Inventory"');
        Artisan::call('config:cache');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_inventory_status');
        Schema::dropIfExists('inventory');
        Schema::dropIfExists('inventory_status');
        Schema::dropIfExists('inventory_category');
    }
}
