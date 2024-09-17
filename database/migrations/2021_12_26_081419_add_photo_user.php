<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->date('birth_date')->nullable()->after('password');
            $table->enum('gender', ['m', 'f'])->nullable()->after('birth_date');
            $table->string('address')->nullable()->after('gender');
            $table->string('phone_number')->nullable()->after('address');
            $table->string('photo_profile_path')->nullable()->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropColumn('photo_profile_path');
            $table->dropColumn('birth_date');
            $table->dropColumn('gender');
            $table->dropColumn('phone_number');
            $table->dropColumn('address');
        });
    }
}
