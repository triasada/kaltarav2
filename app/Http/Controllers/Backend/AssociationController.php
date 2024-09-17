<?php

namespace App\Http\Controllers\Backend;

use App\AccreditationStructure;
use App\Association;
use App\AssociationType;
use App\District;
use App\Http\Controllers\Controller;
use App\Imports\ImportAsosasiBadanUsaha;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('View Association', Auth::user());
        $associations = Association::paginate(8);
        $data['title'] = 'List Association';
        $data['associations'] = $associations;

        return view('association.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Create Association', Auth::user());

        $districts = District::get()->pluck('name', 'id');
        $associationTypes = AssociationType::get()->pluck('name', 'id');
        $data['title'] = 'Create Association';
        $data['districts'] = $districts;
        $data['associationTypes'] = $associationTypes;
        $data['accreditationStructures'] = AccreditationStructure::get()->pluck('name', 'id');
        return view('association.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Create Association', Auth::user());

        try
        {
            DB::transaction(function () use ($request)
            {
                $association = new Association();
                $association->name = $request->name;
                $association->formed_date = Carbon::createFromFormat('d-m-Y', $request->formed_date);
                $association->association_type_id = $request->association_type_id;
                $association->email = $request->email;
                $association->address = $request->address;
                $association->district_id = $request->district_id;
                $association->phone_number = $request->phone_number;
                if($request->contact_person_name)
                    $association->contact_person_name = $request->contact_person_name;
                if($request->contact_person_number)
                    $association->contact_person_number = $request->contact_person_number;
                $association->member_number = $request->member_number;
                $association->accreditation_structure_id = $request->accreditation_structure_id;
                $association->save();

                $file = $request->orgatization_structure_path;
                if($file)
                {
                    $config['disk'] = 'upload';
                    $config['upload_path'] = '/association/'.$association->id;
                    $config['public_path'] = env('APP_URL') . '/association/'.$association->id;

                    // create directory if doesn't exist
                    if (!Storage::disk($config['disk'])->has($config['upload_path']))
                    {
                        Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                    }

                    // upload file if valid
                    if ($file->isValid())
                    {
                        $filename = $file->getClientOriginalName();
                        $oldPath = $association->orgatization_structure_path;

                        Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);

                        // delete old file
                        Storage::disk($config['disk'])->delete($oldPath);

                        // save new path
                        $association->orgatization_structure_path = $config['disk'].$config['upload_path'].'/'.$filename;
                        $association->save();
                    }
                }
            });

            return redirect()->route('association.index')->withSuccess('Association created');
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
        $this->authorize('Edit Association', Auth::user());

        $association = Association::findOrFail($id);
        $districts = District::get()->pluck('name', 'id');
        $associationTypes = AssociationType::get()->pluck('name', 'id');
        $data['title'] = 'Edit Association';
        $data['districts'] = $districts;
        $data['association'] = $association;
        $data['associationTypes'] = $associationTypes;
        $data['accreditationStructures'] = AccreditationStructure::get()->pluck('name', 'id');
        return view('association.edit', $data);
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
        $this->authorize('Edit Association', Auth::user());

        $association = Association::findOrFail($id);

        try
        {
            DB::transaction(function () use ($request, $association)
            {
                $association->name = $request->name;
                $association->formed_date = Carbon::createFromFormat('d-m-Y', $request->formed_date);
                $association->association_type_id = $request->association_type_id;
                $association->email = $request->email;
                $association->address = $request->address;
                $association->district_id = $request->district_id;
                $association->phone_number = $request->phone_number;
                if($request->contact_person_name)
                    $association->contact_person_name = $request->contact_person_name;
                if($request->contact_person_number)
                    $association->contact_person_number = $request->contact_person_number;
                $association->member_number = $request->member_number;
                $association->accreditation_structure_id = $request->accreditation_structure_id;
                $association->save();

                $file = $request->orgatization_structure_path;
                if($file)
                {
                    $config['disk'] = 'upload';
                    $config['upload_path'] = '/association/'.$association->id;
                    $config['public_path'] = env('APP_URL') . '/association/'.$association->id;

                    // create directory if doesn't exist
                    if (!Storage::disk($config['disk'])->has($config['upload_path']))
                    {
                        Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                    }

                    // upload file if valid
                    if ($file->isValid())
                    {
                        $filename = $file->getClientOriginalName();
                        $oldPath = $association->orgatization_structure_path;

                        Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);

                        // delete old file
                        Storage::disk($config['disk'])->delete($oldPath);

                        // save new path
                        $association->orgatization_structure_path = $config['disk'].$config['upload_path'].'/'.$filename;
                        $association->save();
                    }
                }
            });

            return redirect()->route('association.index')->withSuccess('Association updated');
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
        $this->authorize('Delete Association', Auth::user());
        $association = Association::findOrFail($id);
        $association->delete();
        return redirect()->route('association.index')->withSuccess('Association deleted');
    }

    public function import()
    {
        $this->authorize('Create Association', Auth::user());

        $data['title'] = 'Import Asosiasi';
        return view('association.import', $data);
    }

    public function storeImport(Request $request)
    {
        $this->authorize('Create Association', Auth::user());
        try
        {
            $template = $request->file_template;
            Excel::import(new ImportAsosasiBadanUsaha, $template);
            return redirect()->back()->withSuccess('Importe berhasil');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            return redirect()->back()->withErrors($message);
        }
    }
}
