<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccreditationStructure extends Model
{
    protected $table = 'accreditation_structure';

    protected $fillable = [
        'name'
    ];
}
