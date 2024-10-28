<?php

namespace App\Http\Controllers\Backend;

use App\HargaSatuan;
use App\HargaSatuanPekerjaan;
use App\HargaSatuanPekerjaanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HargaSatuanPekerjaanController extends Controller
{
    public function index()
    {
        $pekerjaans = HargaSatuanPekerjaan::with('details.hargaSatuan')->get();
        return view('pekerjaan.index', compact('pekerjaans'));
    }

    public function create()
{
    $upahList = HargaSatuan::where('jenis', 'UPAH')->get();
    $bahanList = HargaSatuan::where('jenis', 'BAHAN')->get();
    $alatList = HargaSatuan::where('jenis', 'ALAT')->get();

    return view('pekerjaan.create', compact('upahList', 'bahanList', 'alatList'));
}

public function store(Request $request)
{
    $pekerjaan = HargaSatuanPekerjaan::create($request->only('title', 'satuan'));

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
    // Load pekerjaan with related details and harga_satuan
    $pekerjaan = HargaSatuanPekerjaan::with('details.hargaSatuan')->findOrFail($id);

    // Load harga_satuan items by jenis
    $upahList = HargaSatuan::where('jenis', 'UPAH')->get();
    $bahanList = HargaSatuan::where('jenis', 'BAHAN')->get();
    $alatList = HargaSatuan::where('jenis', 'ALAT')->get();

    // Debug the fetched data
    // dd($pekerjaan);

    return view('pekerjaan.edit', compact('pekerjaan', 'upahList', 'bahanList', 'alatList'));
}


public function update(Request $request, $id)
{
    $pekerjaan = HargaSatuanPekerjaan::findOrFail($id);

    // Update pekerjaan's main data
    $pekerjaan->update($request->only('title', 'satuan'));

    // Handle the removed details if any
    if ($request->has('removed_details')) {
        $removedDetails = json_decode($request->removed_details, true);
        HargaSatuanPekerjaanDetail::whereIn('id', $removedDetails)->delete();
    }

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