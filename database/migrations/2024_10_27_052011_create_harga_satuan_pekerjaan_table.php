<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargaSatuanPekerjaanTable extends Migration
{
    public function up()
    {
        Schema::create('harga_satuan_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('satuan');
            $table->double('biaya')->default(0); // Total biaya from details
            $table->timestamps();
        });

        Schema::create('harga_satuan_pekerjaan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pekerjaan_id');
            $table->unsignedBigInteger('harga_satuan_id');
            $table->double('koefisien')->default(1);
            $table->double('total_harga')->default(0);

            $table->foreign('pekerjaan_id')->references('id')->on('harga_satuan_pekerjaan')->onDelete('cascade');
            $table->foreign('harga_satuan_id')->references('id')->on('harga_satuan')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('harga_satuan_pekerjaan_details');
        Schema::dropIfExists('harga_satuan_pekerjaan');
    }
}
