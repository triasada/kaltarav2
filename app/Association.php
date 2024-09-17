<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'association';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'formed_date'];

    public function associationType()
    {
        return $this->belongsTo('App\AssociationType');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function accreditationStructure()
    {
        return $this->belongsTo('App\AccreditationStructure');
    }
    
    /**
     * Get the scanfilename
     *
     * @param  string  $value
     * @return string
     */
    public function getScanFileNameAttribute()
    {
        $splited = explode('/', $this->orgatization_structure_path);
        return $splited[sizeof($splited) - 1];
    }
}
