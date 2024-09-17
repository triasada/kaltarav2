<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gallery';

    public function content()
    {
        return $this->belongsTo('App\Content');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
