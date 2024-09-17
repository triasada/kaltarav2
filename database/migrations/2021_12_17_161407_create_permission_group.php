<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_group', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('permissions', function (Blueprint $table)
        {
            $table->unsignedBigInteger('permission_group_id')->after('id');
            $table->foreign('permission_group_id')->references('id')->on('permission_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::table('permissions', function (Blueprint $table)
        {
            $table->dropForeign('permissions_permission_group_id_foreign');
            $table->dropColumn('permission_group_id');
        });
        Schema::dropIfExists('permission_group');
    }
}
