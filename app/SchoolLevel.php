<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolLevel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'school_level';

    public function schoolMajors()
    {
        return $this->hasMany('App\SchoolMajor');
    }
}
