<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'inventory_category_id', 
        'amount', 
        'description', 
        'owner_year',
        'owner_name',
        'production_year',
        'type',
        'district_id',
        'owner_quarry',
        'status_quarry'
    ];

    public function inventoryCategory()
    {
        return $this->belongsTo('App\InventoryCategory');
    }

    public function inventoryStatus()
    {
        return $this->belongsToMany('App\InventoryStatus')->withPivot('amount');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function getViewLocationAttribute()
    {
        if(is_null($this->district_id))
        {
            return '-';
        }
        if($this->district_id == 0)
        {
            return 'Provinsi';
        }
        return $this->district->name;
    }
}
