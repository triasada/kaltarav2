<?php

namespace App\Http\Controllers\Frontend;

use App\BusinessEntity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessEntityController extends Controller
{
    public function index()
    {
        $businessEntities = BusinessEntity::with('businessType')
                            ->paginate(5);

        $data['title'] = 'Badan Usaha';
        $data['businessEntities'] = $businessEntities;
        return view('business_entity.index_public', $data);
    }
}
