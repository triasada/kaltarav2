<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'certification';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'registration_start_date', 'registration_end_date', 'start_date', 'end_date'];

    public function participants()
    {
        return $this->hasMany('App\CertificationParticipant');
    }

    /**
     * Scope a query to only include active
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function isRegistrationOpen()
    {
        $now = Carbon::now();
        return $this->registration_start_date->lte($now) && $now->lte($this->registration_end_date);
    }
}
