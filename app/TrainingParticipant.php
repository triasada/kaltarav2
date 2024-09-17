<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingParticipant extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'training_participant';
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'birth_date'];

    public function training()
    {
        return $this->belongsTo('App\Training');
    }

    public function job()
    {
        return $this->belongsTo('App\Jobs', 'jobs_id');
    }
    
    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function educationLevel()
    {
        return $this->belongsTo('App\EducationLevel');
    }
}
