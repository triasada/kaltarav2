<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessEntity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_entity';

    public function businessType()
    {
        return $this->belongsTo('App\BusinessType');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }
}
