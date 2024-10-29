<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HargaSatuanPekerjaan extends Model
{
    protected $fillable = ['title', 'satuan', 'biaya','kabupaten_id'];

    public function details()
{
    return $this->hasMany(HargaSatuanPekerjaanDetail::class, 'pekerjaan_id');
}
public function district()
{
    return $this->belongsTo(District::class, 'kabupaten_id');
}
    
}