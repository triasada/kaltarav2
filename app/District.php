<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'district';
    protected $fillable = ['name'];

    public function pekerjaans()
    {
        return $this->hasMany(HargaSatuanPekerjaan::class, 'kabupaten_id');
    }
}
