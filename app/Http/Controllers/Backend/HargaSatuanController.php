<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\HargaSatuan;
use App\District;
use App\Kecamatan;
use Illuminate\Http\Request;

class HargaSatuanController extends Controller
{
    public function index()
    {
        $hargaSatuans = HargaSatuan::with(['kabupaten', 'kecamatan'])->get();
        return view('harga_satuan.index', compact('hargaSatuans'));
    }

    public function create()
    {
        $districts = District::all();
        $kecamatans = Kecamatan::all();
        return view('harga_satuan.create', compact('districts', 'kecamatans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required|string|max:8',
            'nama' => 'required|string|max:200',
            'jenis' => 'required|string|max:100',
            'satuan' => 'required|string|max:5',
            'kabupaten_id' => 'required|exists:districts,id',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'harga' => 'required|numeric',
        ]);

        HargaSatuan::create($validatedData);

        return redirect()->route('harga_satuan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $hargaSatuan = HargaSatuan::findOrFail($id);
        $districts = District::all();
        $kecamatans = Kecamatan::all();
        return view('harga_satuan.edit', compact('hargaSatuan', 'districts', 'kecamatans'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode' => 'required|string|max:8',
            'nama' => 'required|string|max:200',
            'jenis' => 'required|string|max:100',
            'satuan' => 'required|string|max:5',
            'kabupaten_id' => 'required|exists:districts,id',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'harga' => 'required|numeric',
        ]);

        HargaSatuan::whereId($id)->update($validatedData);

        return redirect()->route('harga_satuan.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        HargaSatuan::findOrFail($id)->delete();
        return redirect()->route('harga_satuan.index')->with('success', 'Data berhasil dihapus');
    }
    public function getKecamatan($kabupaten_id)
    {
        $kecamatans = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
        return response()->json($kecamatans);
    }
}

