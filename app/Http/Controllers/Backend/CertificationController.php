<?php

namespace App\Http\Controllers\Backend;

use App\Certification;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('View Certification', Auth::user());
        $certifications = Certification::orderBy('start_date', 'desc')
                                        ->paginate(8);
        $data['title'] = 'List Certification';
        $data['certifications'] = $certifications;
        return view('certification.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Create Certification', Auth::user());

        $data['title'] = 'Create Certification';
        return view('certification.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Create Certification', Auth::user());

        try
        {
            DB::transaction(function () use ($request)
            {
                $regStart = Carbon::createFromFormat('d-m-Y', $request->registration_start_date);
                $regEnd = Carbon::createFromFormat('d-m-Y', $request->registration_end_date);
                $certification = new Certification();
                $certification->title = $request->title;
                $certification->description = $request->description;
                $certification->start_date = Carbon::createFromFormat('d-m-Y', $request->start_date);
                $certification->end_date = Carbon::createFromFormat('d-m-Y', $request->end_date);
                $certification->registration_start_date = $regStart;
                $certification->registration_end_date = $regEnd;
                $now = Carbon::now();
                if ($now->lte($regEnd) && $now->gte($regStart))
                {
                    $certification->is_active = 1;
                }
                else
                {
                    $certification->is_active = 0;
                }
                $certification->save();
            });
            return redirect()->route('certification.index')->withSuccess('Certification Created');
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
        $this->authorize('Edit Certification', Auth::user());

        $certification = Certification::findOrFail($id);

        $data['title'] = 'Edit Certification';
        $data['certification'] = $certification;
        return view('certification.edit', $data);
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
        $this->authorize('Edit Certification', Auth::user());

        $certification = Certification::findOrFail($id);

        try
        {
            DB::transaction(function () use ($request, $certification)
            {
                $regStart = Carbon::createFromFormat('d-m-Y', $request->registration_start_date);
                $regEnd = Carbon::createFromFormat('d-m-Y', $request->registration_end_date);
                $certification->title = $request->title;
                $certification->description = $request->description;
                $certification->start_date = Carbon::createFromFormat('d-m-Y', $request->start_date);
                $certification->end_date = Carbon::createFromFormat('d-m-Y', $request->end_date);
                $certification->registration_start_date = $regStart;
                $certification->registration_end_date = $regEnd;
                $now = Carbon::now();
                if ($now->lte($regEnd) && $now->gte($regStart))
                {
                    $certification->is_active = 1;
                }
                else
                {
                    $certification->is_active = 0;
                }
                $certification->save();
            });
            return redirect()->route('certification.index')->withSuccess('Certification Updated');
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
        $this->authorize('Delete Certification', Auth::user());

        $certification = Certification::findOrFail($id);
        $certification->delete();
        return redirect()->route('certification.index')->withSuccess('Certification Deleted');
    }
}
