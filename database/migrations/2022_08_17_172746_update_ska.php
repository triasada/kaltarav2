<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class UpdateSka extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ska_classification', function (Blueprint $table) {
            $table->string('chart_background', 50)->nullable()->after('name');
        });

        Artisan::call('db:seed', ['--class' => 'SkaChartSeed']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ska_classification', function (Blueprint $table) {
            $table->dropColumn('chart_background');
        });
    }
}
