<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HargaSatuanPekerjaanDetail extends Model
{
    protected $fillable = ['pekerjaan_id', 'harga_satuan_id', 'koefisien', 'total_harga'];

    public function hargaSatuan()
{
    return $this->belongsTo(HargaSatuan::class, 'harga_satuan_id');
}
}