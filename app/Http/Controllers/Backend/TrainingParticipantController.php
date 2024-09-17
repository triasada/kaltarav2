<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Exports\TrainingParticipantExport;
use App\Http\Controllers\Controller;
use App\Training;
use App\TrainingParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TrainingParticipantController extends Controller
{
    public function participant($id)
    {
        $this->authorize('View Participant Training', Auth::user());

        $training = Training::findOrFail($id);
        
        $participants = TrainingParticipant::where('training_id', $id)
                                                ->get();

        $data['title'] = 'Training Participants';
        $data['participants'] = $participants;
        $data['training'] = $training;
        return view('training.participant', $data);                                        
    }

    public function participantExcel($id)
    {
        $this->authorize('View Participant Training', Auth::user());

        $training = Training::findOrFail($id);

        $participants = TrainingParticipant::where('training_id', $id)
                                                ->get();

        $data['participants'] = $participants;
        $filename = Carbon::now() .'.xls';
        // $filename = 'peserta '.$training->title.'.xls';
        return Excel::download(new TrainingParticipantExport($data), $filename);
    }
}
