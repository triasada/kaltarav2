<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargaSatuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('harga_satuans', function (Blueprint $table) {
        $table->id();
        $table->string('kode', 8);
        $table->string('nama', 200);
        $table->string('jenis', 100);
        $table->string('satuan', 5);
        $table->unsignedBigInteger('kabupaten_id');
        $table->unsignedBigInteger('kecamatan_id');
        $table->double('harga');
        
        $table->foreign('kabupaten_id')->references('id')->on('districts');
        $table->foreign('kecamatan_id')->references('id')->on('kecamatans');
        
        $table->unique(['kode', 'nama', 'jenis', 'satuan', 'kabupaten_id', 'kecamatan_id'], 'unique_harga_satuan');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('harga_satuans');
    }
}
