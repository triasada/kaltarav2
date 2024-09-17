<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    public function expertDatas()
    {
        return $this->hasMany('App\ExpertData');
    }
}
