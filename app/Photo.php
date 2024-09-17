<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'photo';

    public function content()
    {
        return $this->belongsTo('App\Content');
    }

    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }
}
