<?php

namespace App\Http\Controllers\Backend;

use App\District;
use App\Http\Controllers\Controller;
use App\Imports\ImportAlatDanBahan;
use App\Inventory;
use App\InventoryStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('View Inventory', Auth::user());
        $inventories = Inventory::with('inventoryCategory')
                                ->where('inventory_category_id', INVENTORY_CATEGORY_BAHAN_MATERIAL)
                                ->get();
        $data['title'] = 'List Bahan & Material';
        $data['inventories'] = $inventories;
        return view('inventory.material.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Create Inventory', Auth::user());
        $inventoryStatus = InventoryStatus::get();
        $districts = District::get();
        $data['title'] = 'Tambah Bahan & Material';
        $data['inventoryStatus'] = $inventoryStatus;
        $data['districts'] = $districts;
        return view('inventory.material.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $this->authorize('Create Inventory', Auth::user());

            DB::transaction(function () use ($request)
            {
                $form = $request->toArray();
                unset($form['_token']);
                Inventory::create($form);
            });

            return redirect()->route('inventory-material.index')->withSuccess('Data berhasil disimpan');
        }
        catch (\Throwable $th)
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi kesalahan');
        }
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
        $this->authorize('Edit Inventory', Auth::user());
        $inventoryStatus = InventoryStatus::get();
        $districts = District::get();
        $data['title'] = 'Edit Bahan & Material';
        $data['inventoryStatus'] = $inventoryStatus;
        $data['districts'] = $districts;
        $data['inventory'] = Inventory::findOrFail($id);
        return view('inventory.material.edit', $data);
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
        try
        {
            $this->authorize('Edit Inventory', Auth::user());

            $inventory = Inventory::findOrFail($id);
            DB::transaction(function () use ($request, $inventory)
            {
                $inventory->name = $request->name;
                $inventory->type = $request->type;
                $inventory->owner_quarry = $request->owner_quarry;
                $inventory->status_quarry = $request->status_quarry;
                $inventory->district_id = $request->district_id;
                $inventory->save();
            });

            return redirect()->route('inventory-material.index')->withSuccess('Data berhasil disimpan');
        }
        catch (\Throwable $th)
        {
            Log::error($th);
            return redirect()->back()->withErrors('Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Inventory', Auth::user());
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return redirect()->route('inventory-material.index')->withSuccess('Data berhasil Dihapus');
    }

    public function import()
    {
        $this->authorize('Create Inventory', Auth::user());

        $data['title'] = 'Import Bahan & Material';
        return view('inventory.material.import', $data);
    }

    public function storeImport(Request $request)
    {
        $this->authorize('Create Inventory', Auth::user());
        try
        {
            $template = $request->file_template;
            Excel::import(new ImportAlatDanBahan, $template);
            return redirect()->back()->withSuccess('Import berhasil');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            return redirect()->back()->withErrors($message);
        }
    }
}
