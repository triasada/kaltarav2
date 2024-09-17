<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Inventory;
use App\InventoryCategory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function showAlatBerat($categoryId = null)
    { 
        $inventories = Inventory::where('inventory_category_id', INVENTORY_CATEGORY_ALAT_BERAT)
                                    ->get();
        $category = InventoryCategory::where('id', INVENTORY_CATEGORY_ALAT_BERAT)
                                    ->first();

        $data['title'] = 'Alat Berat';
        $data['category'] = $category;
        $data['inventories'] = $inventories;
        return view('inventory.index_public', $data);
    }

    public function bahanMaterial($categoryId = null)
    { 
        $inventories = Inventory::where('inventory_category_id', INVENTORY_CATEGORY_BAHAN_MATERIAL)
                                    ->get();
        $category = InventoryCategory::where('id', INVENTORY_CATEGORY_BAHAN_MATERIAL)
                                    ->first();

        $data['title'] = 'Bahan & Material';
        $data['category'] = $category;
        $data['inventories'] = $inventories;
        return view('inventory.index_public', $data);
    }
}
