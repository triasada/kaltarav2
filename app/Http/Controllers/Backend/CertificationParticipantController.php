<?php

namespace App\Http\Controllers\Backend;

use App\Certification;
use App\CertificationParticipant;
use App\Exports\CertificationParticipantExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CertificationParticipantController extends Controller
{
    public function participant($id)
    {
        $this->authorize('View Participant Certification', Auth::user());

        $certification = Certification::findOrFail($id);
        
        $participants = CertificationParticipant::where('certification_id', $id)
                                                ->get();

        $data['title'] = 'Certification Participants';
        $data['participants'] = $participants;
        $data['certification'] = $certification;
        return view('certification.participant', $data);                                        
    }

    public function participantExcel($id)
    {
        $this->authorize('View Participant Certification', Auth::user());

        $certification = Certification::findOrFail($id);

        $participants = CertificationParticipant::where('certification_id', $id)
                                                ->get();

        $data['participants'] = $participants;
        $filename = 'peserta '.$certification->title.'.xls';
        return Excel::download(new CertificationParticipantExport($data), $filename);
    }
}
