<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSeeker extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_seeker';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'birth_date'];

    public function jobType()
    {
        return $this->belongsTo('App\JobSeekerJobType', 'job_seeker_job_type_id');
    }

    public function schoolLevel()
    {
        return $this->belongsTo('App\JobSeekerSchoolLevel', 'job_seeker_school_level_id');
    }

    public function certificationType()
    {
        return $this->belongsTo('App\CertificationType');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function qualification()
    {
        return $this->belongsTo('App\Qualification');
    }

    /**
     * Get the certification_name
     *
     * @param  string  $value
     * @return string
     */
    public function getCertificationNameAttribute()
    {
        if($this->certification_type_id == CLASSIFICATION_TYPE_SKA)
        {
            return SkaClassification::find($this->class_certification_type_id)->name;
        }
        elseif($this->certification_type_id == CLASSIFICATION_TYPE_SKT)
        {
            return SktClassification::find($this->class_certification_type_id)->name;
        }
        elseif($this->certification_type_id == 3)
        {
            return 'Tidak Tersertifikasi';
        }
        return '-';
    }
}
