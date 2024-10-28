<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HargaSatuan;
use App\District;
use App\Kecamatan;

class HargaSatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Fetch all districts for the top menu links
        $districts = District::all();

        // Get the selected district from the query string or default to 'Bulungan' (ID: 2)
        $selectedDistrictId = $request->query('district_id', 2);

        // Fetch kecamatans for the selected district
        $kecamatans = Kecamatan::where('kabupaten_id', $selectedDistrictId)->get();

        // Group harga_satuan data by kode and filter by the selected district's kabupaten_id
        $hargaSatuans = HargaSatuan::where('kabupaten_id', $selectedDistrictId)
            ->with(['kabupaten', 'kecamatan'])
            ->get()
            ->groupBy('kode');

        // Prepare a nested map of [kode][kecamatan_id] => harga
        $hargaMap = [];
        foreach ($hargaSatuans as $kode => $items) {
            foreach ($items as $item) {
                $hargaMap[$kode][$item->kecamatan_id] = $item->harga;
            }
        }

        return view('harga_satuan.index_public', compact('districts', 'hargaSatuans', 'kecamatans', 'hargaMap', 'selectedDistrictId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
