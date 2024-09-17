<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolMajor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'school_major';

    public function schoolLevel()
    {
        return $this->belongsTo('App\SchoolLevel');
    }
}
