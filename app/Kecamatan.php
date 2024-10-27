<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatans';
    protected $fillable = ['kabupaten', 'kode', 'kabupaten_id'];

    public function kabupaten()
    {
        return $this->belongsTo(District::class, 'kabupaten_id');
    }
}
