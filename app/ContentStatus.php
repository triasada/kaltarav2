<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content_status';

    public function contents()
    {
        return $this->hasMany('App\Content');
    }
}
