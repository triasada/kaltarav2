<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    public function getSummaryAttribute()
    {
        return str_limit(strip_tags(html_entity_decode($this->body)), 300, '...');
    }
}
