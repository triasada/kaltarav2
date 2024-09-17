<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpertData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expert_data';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'birth_date', 'expire_date'];

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function job()
    {
        return $this->belongsTo('App\Jobs', 'jobs_id');
    }

    public function skaClassification()
    {
        return $this->belongsTo('App\SkaClassification');
    }

    public function educationLevel()
    {
        return $this->belongsTo('App\EducationLevel');
    }

    /**
     * Get the status
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute()
    {
        if($this->is_active)
        {
            return 'Active';
        }
        return 'Non Active';
    }

    /**
     * Get the viewGender
     *
     * @param  string  $value
     * @return string
     */
    public function getViewGenderAttribute()
    {
        if($this->gender == 'm')
        {
            return 'Laki-laki';
        }
        elseif($this->gender == 'f')
        {
            return 'Perempuan';
        }
        return '-';
    }
}
