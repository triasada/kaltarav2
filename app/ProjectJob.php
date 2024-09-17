<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectJob extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_job';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];

    public function projectJobDesk()
    {
        return $this->belongsTo('App\ProjectJobDesk');
    }

    public function projectJobType()
    {
        return $this->belongsTo('App\ProjectJobType');
    }

    public function projectJobSource()
    {
        return $this->belongsTo('App\ProjectJobSource');
    }

    public function projectJobInstantion()
    {
        return $this->belongsTo('App\ProjectJobInstantion');
    }

    public function projectJobContractType()
    {
        return $this->belongsTo('App\ProjectJobContractType');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }
}
