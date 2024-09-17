<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Inventory;
use App\InventoryCategory;
use App\InventoryStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
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
                                ->get();
        $data['title'] = 'List Inventory';
        $data['inventories'] = $inventories;
        return view('inventory.index', $data);
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
        $inventoryCategories = InventoryCategory::get();
        $data['title'] = 'Add Inventory';
        $data['inventoryStatus'] = $inventoryStatus;
        $data['inventoryCategories'] = $inventoryCategories;
        return view('inventory.create', $data);
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
                unset($form['status']);
                unset($form['img_path']);
                $inventory = Inventory::create($form);

                $file = $request->img_path;
                if ($file)
                {
                    $config['disk'] = 'upload';
                    $config['upload_path'] = '/inventory/'.$inventory->id;
                    $config['public_path'] = env('APP_URL') . '/upload/inventory/'.$inventory->id;

                    // create directory if doesn't exist
                    if (!Storage::disk($config['disk'])->has($config['upload_path']))
                    {
                        Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                    }

                    // upload file if valid
                    if ($file->isValid())
                    {
                        $filename = uniqid() .'.'. $file->getClientOriginalExtension();

                        Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);
                        $inventory->img_path = $config['disk'].$config['upload_path'].'/'.$filename;
                        $inventory->save();
                    }
                }
            });

            return redirect()->route('inventory.index')->withSuccess('Data berhasil disimpan');
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
        $inventoryCategories = InventoryCategory::get();
        $inventory = Inventory::findOrFail($id);
        $data['title'] = 'Add Inventory';
        $data['inventoryStatus'] = $inventoryStatus;
        $data['inventoryCategories'] = $inventoryCategories;
        $data['inventory'] = $inventory;
        return view('inventory.edit', $data);
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
        $this->authorize('Edit Inventory', Auth::user());
        try 
        {
            $inventory = Inventory::findOrFail($id);
            DB::transaction(function () use ($inventory, $request)
            {
                $inventory->name = $request->name;
                $inventory->inventory_category_id = $request->inventory_category_id;
                $inventory->description = $request->description;
                $inventory->amount = $request->amount?$request->amount:0;
                $file = $request->img_path;
                if ($file)
                {
                    $config['disk'] = 'upload';
                    $config['upload_path'] = '/inventory/'.$inventory->id;
                    $config['public_path'] = env('APP_URL') . '/upload/inventory/'.$inventory->id;

                    // create directory if doesn't exist
                    if (!Storage::disk($config['disk'])->has($config['upload_path']))
                    {
                        Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                    }

                    // upload file if valid
                    if ($file->isValid())
                    {
                        $filename = uniqid() .'.'. $file->getClientOriginalExtension();

                        Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);
                        $inventory->img_path = $config['disk'].$config['upload_path'].'/'.$filename;
                    }
                }
                $inventory->save();
                $sync = [];
                foreach ($request->status as $key => $value) 
                {
                    $sync[$key] = ['amount' => $value];
                }
                $inventory->inventoryStatus()->sync($sync);
            });
            return redirect()->route('inventory.index')->withSuccess('Data berhasil disimpan');
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
        $inventory->inventoryStatus()->sync([]);
        $inventory->delete();
        return redirect()->route('inventory.index')->withSuccess('Data berhasil Dihapus');
    }
}
