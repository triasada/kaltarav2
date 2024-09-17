<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('View Training', Auth::user());
        $trainings = Training::orderBy('start_date', 'desc')
                                        ->paginate(8);
        $data['title'] = 'List Training';
        $data['trainings'] = $trainings;
        return view('training.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Create Training', Auth::user());

        $data['title'] = 'Create Training';
        return view('training.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Create Training', Auth::user());

        try
        {
            DB::transaction(function () use ($request)
            {
                $regStart = Carbon::createFromFormat('d-m-Y', $request->registration_start_date);
                $regEnd = Carbon::createFromFormat('d-m-Y', $request->registration_end_date);
                $training = new Training();
                $training->title = $request->title;
                $training->description = $request->description;
                $training->start_date = Carbon::createFromFormat('d-m-Y', $request->start_date);
                $training->end_date = Carbon::createFromFormat('d-m-Y', $request->end_date);
                $training->registration_start_date = $regStart;
                $training->registration_end_date = $regEnd;
                $now = Carbon::now();
                if ($now->lte($regEnd) && $now->gte($regStart))
                {
                    $training->is_active = 1;
                }
                else
                {
                    $training->is_active = 0;
                }
                $training->save();
            });
            return redirect()->route('training.index')->withSuccess('Training Created');
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
        $this->authorize('Edit Training', Auth::user());

        $training = Training::findOrFail($id);

        $data['title'] = 'Edit Training';
        $data['training'] = $training;
        return view('training.edit', $data);
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
        $this->authorize('Edit Training', Auth::user());

        $training = Training::findOrFail($id);

        try
        {
            DB::transaction(function () use ($request, $training)
            {
                $regStart = Carbon::createFromFormat('d-m-Y', $request->registration_start_date);
                $regEnd = Carbon::createFromFormat('d-m-Y', $request->registration_end_date);
                $training->title = $request->title;
                $training->description = $request->description;
                $training->start_date = Carbon::createFromFormat('d-m-Y', $request->start_date);
                $training->end_date = Carbon::createFromFormat('d-m-Y', $request->end_date);
                $training->registration_start_date = $regStart;
                $training->registration_end_date = $regEnd;
                $now = Carbon::now();
                if ($now->lte($regEnd) && $now->gte($regStart))
                {
                    $training->is_active = 1;
                }
                else
                {
                    $training->is_active = 0;
                }
                $training->save();
            });
            return redirect()->route('training.index')->withSuccess('Training Updated');
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
        $this->authorize('Delete Training', Auth::user());

        $training = Training::findOrFail($id);
        $training->delete();
        return redirect()->route('training.index')->withSuccess('Training Deleted');
    }
}
