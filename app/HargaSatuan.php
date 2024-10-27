<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HargaSatuan extends Model
{
    protected $table = 'harga_satuans';
    protected $fillable = ['kode', 'nama', 'jenis', 'satuan', 'kabupaten_id', 'kecamatan_id', 'harga'];

    public function kabupaten()
    {
        return $this->belongsTo(District::class, 'kabupaten_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}
