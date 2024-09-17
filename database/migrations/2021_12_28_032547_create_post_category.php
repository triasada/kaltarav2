<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('post', function (Blueprint $table)
        {
            $table->foreignId('post_category_id')
                    ->after('content_id')
                    ->nullable()
                    ->constrained('post_category')
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
        Schema::table('post', function (Blueprint $table)
        {
            $table->dropForeign('post_post_category_id_foreign');
            $table->dropColumn('post_category_id');
        });
        Schema::dropIfExists('post_category');
    }
}
