<?php

namespace App\Http\Controllers\Backend;

use App\Association;
use App\BusinessEntity;
use App\BusinessType;
use App\District;
use App\Http\Controllers\Controller;
use App\Imports\ImportBadanUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class BusinessEntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('View Business Entity', Auth::user());
        $businessEntities = BusinessEntity::orderBy('created_at', 'desc')
                                        ->paginate(8);
        $data['title'] = 'List Business Entity';
        $data['businessEntities'] = $businessEntities;
        return view('business_entity.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Create Business Entity', Auth::user());

        $districts = District::get()->pluck('name', 'id');
        $businessTypes = BusinessType::get()->pluck('name', 'id');
        $associations = Association::get()->pluck('name', 'id');
        $data['title'] = 'Create Business Entity';
        $data['districts'] = $districts;
        $data['businessTypes'] = $businessTypes;
        $data['associations'] = $associations;
        return view('business_entity.create', $data);
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
            $this->authorize('Create Business Entity', Auth::user());
            DB::transaction(function () use ($request)
            {
                $businessEntity = new BusinessEntity();
                $businessEntity->business_type_id = $request->business_type_id;
                $businessEntity->name = $request->name;
                $businessEntity->address = $request->address;
                $businessEntity->district_id = $request->district_id;
                $businessEntity->phone_number = $request->phone_number;
                $businessEntity->email = $request->email;
                $businessEntity->association_id = $request->association_id;
                $businessEntity->certified_workers_number = $request->certified_workers_number;
                $businessEntity->SKA = $request->SKA;
                $businessEntity->SKT = $request->SKT;
                $businessEntity->save();
            });
            return redirect()->route('business-entity.index')->withSuccess('Data saved');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
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
        $this->authorize('Edit Business Entity', Auth::user());

        $businessEntity = BusinessEntity::findOrFail($id);
        $districts = District::get()->pluck('name', 'id');
        $businessTypes = BusinessType::get()->pluck('name', 'id');
        $associations = Association::get()->pluck('name', 'id');
        $data['title'] = 'Edit Business Entity';
        $data['districts'] = $districts;
        $data['businessTypes'] = $businessTypes;
        $data['businessEntity'] = $businessEntity;
        $data['associations'] = $associations;
        return view('business_entity.edit', $data);
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
        $this->authorize('Edit Business Entity', Auth::user());

        $businessEntity = BusinessEntity::findOrFail($id);
        try
        {
            DB::transaction(function () use ($request, $businessEntity)
            {
                $businessEntity->business_type_id = $request->business_type_id;
                $businessEntity->name = $request->name;
                $businessEntity->address = $request->address;
                $businessEntity->district_id = $request->district_id;
                $businessEntity->phone_number = $request->phone_number;
                $businessEntity->email = $request->email;
                $businessEntity->association_id = $request->association_id;
                $businessEntity->certified_workers_number = $request->certified_workers_number;
                $businessEntity->SKA = $request->SKA;
                $businessEntity->SKT = $request->SKT;
                $businessEntity->save();
            });
            return redirect()->route('business-entity.index')->withSuccess('Data saved');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
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
        $this->authorize('Deletes Business Entity', Auth::user());

        $businessEntity = BusinessEntity::findOrFail($id);
        $businessEntity->delete();
        return redirect()->route('business-entity.index')->withSuccess('Data deleted');
    }

    public function import()
    {
        $this->authorize('Create Business Entity', Auth::user());

        $data['title'] = 'Import Business Entity';
        return view('business_entity.import', $data);
    }

    public function storeImport(Request $request)
    {
        $this->authorize('Create Business Entity', Auth::user());
        try
        {
            $template = $request->file_template;
            Excel::import(new ImportBadanUsaha, $template);
            return redirect()->back()->withSuccess('Import berhasil');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            return redirect()->back()->withErrors($message);
        }
    }
}
