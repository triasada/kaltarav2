<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkUrl extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'link_url';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'url'];
}
