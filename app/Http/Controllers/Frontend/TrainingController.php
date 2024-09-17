<?php

namespace App\Http\Controllers\Frontend;

use App\District;
use App\EducationLevel;
use App\Http\Controllers\Controller;
use App\Jobs;
use App\Training;
use App\TrainingParticipant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TrainingController extends Controller
{
    public function registration($id)
    {
        $training = Training::active()
                            ->findOrFail($id);
        $jobs = Jobs::get()->pluck('name', 'id');
        $districts = District::get()->pluck('name', 'id');
        $educationLevels = EducationLevel::get()->pluck('name', 'id');
        
        $data['title'] = "Pendaftaran ".$training->title;
        $data['training'] = $training;
        $data['jobs'] = $jobs;
        $data['districts'] = $districts;
        $data['educationLevels'] = $educationLevels;
        return view('training.registration', $data);
    }

    public function registrationStore($id, Request $request)
    {
        try
        {
            $training = Training::active()
                                ->findOrFail($id);

            DB::transaction(function () use ($request, $training)
            {
                $participant = new TrainingParticipant();
                $participant->training_id = $training->id;
                $participant->name = $request->name;
                $participant->id_number = $request->nik;
                $participant->birth_date = Carbon::createFromFormat('d/m/Y', $request->birth_date);
                $participant->gender = $request->gender;
                $participant->jobs_id = $request->jobs_id;
                $participant->address = $request->address;
                $participant->district_id = $request->district_id;
                $participant->phone_number = $request->phone_number;
                $participant->email = $request->email;
                $participant->education_level_id = $request->education_level_id;
                $participant->certification = $request->certification;
                $participant->save();
            });

            return redirect()->back()->withSuccess('Pendaftaran berhasil');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
        }
    }
}
