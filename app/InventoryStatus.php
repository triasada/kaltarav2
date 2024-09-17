<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_status';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function inventories()
    {
        return $this->belongsToMany('App\Inventory');
    }
}
