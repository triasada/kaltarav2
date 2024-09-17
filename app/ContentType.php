<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content_type';

    public function contents()
    {
        return $this->hasMany('App\Content');
    }
}
