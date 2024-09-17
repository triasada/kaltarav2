<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'web_setting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value', 'is_active'];
}
