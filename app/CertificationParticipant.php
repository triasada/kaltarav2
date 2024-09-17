<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificationParticipant extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'certification_participant';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'birth_date'];

    public function certification()
    {
        return $this->belongsTo('App\Certification');
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

    public function skaClassification()
    {
        return $this->belongsTo('App\SkaClassification');
    }

    public function qualification()
    {
        return $this->belongsTo('App\Qualification', 'qualification_id');
    }

    /**
     * Get the view_gender
     *
     * @param  string  $value
     * @return string
     */
    public function getViewGenderAttribute()
    {
        if($this->gender == 'f')
            return 'Perempuan';
        return 'Laki-laki';
    }
}
