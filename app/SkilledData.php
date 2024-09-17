<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkilledData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'skilled_data';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'birth_date'];

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function job()
    {
        return $this->belongsTo('App\Jobs', 'jobs_id');
    }
}
