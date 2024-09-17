<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'school';

    public function schoolLevel()
    {
        return $this->belongsTo('App\SchoolLevel');
    }

    public function schoolMajor()
    {
        return $this->belongsTo('App\SchoolMajor');
    }
}
