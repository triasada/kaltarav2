<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HargaSatuanPekerjaan extends Model
{
    protected $fillable = ['title', 'satuan', 'biaya'];

    public function details()
{
    return $this->hasMany(HargaSatuanPekerjaanDetail::class, 'pekerjaan_id');
}
    
}