<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpireSka extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expert_data', function (Blueprint $table)
        {
            $table->dateTime('expire_date')->nullable()->after('ska_classification_id');
            $table->tinyInteger('is_active')->default(1)->after('qualification_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expert_data', function (Blueprint $table)
        {
            $table->dropColumn('expire_date');
            $table->dropColumn('is_active');
        });
    }
}
