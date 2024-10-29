<?php

namespace App\Http\Controllers\Backend;

use App\HargaSatuan;
use App\District;
use App\HargaSatuanPekerjaan;
use App\HargaSatuanPekerjaanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HargaSatuanPekerjaanController extends Controller
{
    public function index()
    {
        $pekerjaans = HargaSatuanPekerjaan::with(['details.hargaSatuan','district'])->get();
        return view('pekerjaan.index', compact('pekerjaans'));
    }

    public function create()
{
    $districts = District::all(); // Fetch all districts

    $upahList = HargaSatuan::where('jenis', 'UPAH')->get();
    $bahanList = HargaSatuan::where('jenis', 'BAHAN')->get();
    $alatList = HargaSatuan::where('jenis', 'ALAT')->get();

    return view('pekerjaan.create', compact('upahList', 'bahanList', 'alatList','districts'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'satuan' => 'required|string|max:50',
        'kabupaten_id' => 'required|exists:district,id',
    ]);

    HargaSatuanPekerjaan::create($validated);

    foreach (['upah', 'bahan', 'alat'] as $jenis) {
        if (isset($request->details[$jenis])) {
            foreach ($request->details[$jenis] as $detail) {
                if (!isset($detail['harga_satuan_id'])) {
                    continue; // Skip if harga_satuan_id is missing
                }

                $hargaSatuan = HargaSatuan::find($detail['harga_satuan_id']);
                $totalHarga = $detail['koefisien'] * $hargaSatuan->harga;

                HargaSatuanPekerjaanDetail::create([
                    'pekerjaan_id' => $pekerjaan->id,
                    'harga_satuan_id' => $detail['harga_satuan_id'],
                    'koefisien' => $detail['koefisien'],
                    'total_harga' => $totalHarga,
                ]);
            }
        }
    }

    $pekerjaan->biaya = $pekerjaan->details()->sum('total_harga');
    $pekerjaan->save();

    return redirect()->route('pekerjaan.index')->with('success', 'Data saved successfully.');
}


public function edit($id)
{
    $districts = District::all();
    // Load pekerjaan with related details and harga_satuan
    $pekerjaan = HargaSatuanPekerjaan::with('details.hargaSatuan')->findOrFail($id);

    // Load harga_satuan items by jenis
    $upahList = HargaSatuan::where('jenis', 'UPAH')->get();
    $bahanList = HargaSatuan::where('jenis', 'BAHAN')->get();
    $alatList = HargaSatuan::where('jenis', 'ALAT')->get();

    // Debug the fetched data
    // dd($pekerjaan);

    return view('pekerjaan.edit', compact('pekerjaan', 'upahList', 'bahanList', 'alatList','districts'));
}


public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'satuan' => 'required|string|max:50',
        'kabupaten_id' => 'required|exists:district,id',
    ]);
    // dd($request->removed_details);

    $pekerjaan = HargaSatuanPekerjaan::findOrFail($id);
    // dd($pekerjaan->id);
    $pekerjaan->update($validated);

    // Handle the removed details if any
    
        
        HargaSatuanPekerjaanDetail::where('pekerjaan_id', $pekerjaan->id)->delete();
    


    // Loop through each jenis (upah, bahan, alat) to save/update details
    foreach (['upah', 'bahan', 'alat'] as $jenis) {
        if (isset($request->details[$jenis])) {
            foreach ($request->details[$jenis] as $detail) {
                $hargaSatuan = HargaSatuan::find($detail['harga_satuan_id']);
                $totalHarga = $detail['koefisien'] * $hargaSatuan->harga;

                // Check if it's a new or existing detail
                HargaSatuanPekerjaanDetail::updateOrCreate(
                    ['id' => $detail['id'] ?? null], // Update if ID exists, create otherwise
                    [
                        'pekerjaan_id' => $pekerjaan->id,
                        'harga_satuan_id' => $detail['harga_satuan_id'],
                        'koefisien' => $detail['koefisien'],
                        'total_harga' => $totalHarga,
                    ]
                );
            }
        }
    }

    // Update the total biaya (sum of all total_harga)
    $pekerjaan->biaya = $pekerjaan->details()->sum('total_harga');
    $pekerjaan->save();

    return redirect()->route('pekerjaan.index')->with('success', 'Data updated successfully.');
}


public function show($id)
{
    $pekerjaan = HargaSatuanPekerjaan::with('details.hargaSatuan')->findOrFail($id);
    return view('pekerjaan.show', compact('pekerjaan'));
}
public function destroy($id)
{
    $pekerjaan = HargaSatuanPekerjaan::findOrFail($id);
    $pekerjaan->delete();

    return redirect()->route('pekerjaan.index')->with('success', 'Data deleted successfully.');
}



}