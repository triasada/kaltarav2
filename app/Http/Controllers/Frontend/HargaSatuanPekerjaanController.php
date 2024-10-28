<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HargaSatuanPekerjaan;
use App\District;

class HargaSatuanPekerjaanController extends Controller
{
    public function index(Request $request)
    {
        $districts = District::all(); // Fetch all districts
    
        // Get the active district from the query string or default to the first one
        $activeDistrictId = $request->query('district_id', $districts->first()->id ?? null);
    
        // Fetch pekerjaan entries for the selected district
        $pekerjaans = HargaSatuanPekerjaan::where('kabupaten_id', $activeDistrictId)->get();
    
        return view('pekerjaan.index_public', compact('districts', 'pekerjaans', 'activeDistrictId'));
    }
    
public function show($id)
{
    $pekerjaan = HargaSatuanPekerjaan::with('details.hargaSatuan')->findOrFail($id); // Fetch pekerjaan with details
    return view('pekerjaan.show_public', compact('pekerjaan'));
}
}
