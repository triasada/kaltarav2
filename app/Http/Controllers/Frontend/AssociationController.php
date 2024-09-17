<?php

namespace App\Http\Controllers\Frontend;

use App\Association;
use App\AssociationType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function index(Request $request)
    {
        /* $associationTypes = AssociationType::with('association')
                                            ->whereIn('id', [ASSOCIATION_TYPE_BUSINESS_ENTITY, ASSOCIATION_TYPE_PROFESSION])
                                            ->get(); */

        $associations = Association::whereIn('association_type_id', [ASSOCIATION_TYPE_BUSINESS_ENTITY, ASSOCIATION_TYPE_PROFESSION])
                                    ->get();
        $data['title'] = 'Asosiasi (Badan Usaha, Profesi)';
        $data['associations'] = $associations;
        return view('association.index_public', $data);
    }
}
