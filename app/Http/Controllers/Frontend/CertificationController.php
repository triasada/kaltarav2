<?php

namespace App\Http\Controllers\Frontend;

use App\Certification;
use App\CertificationParticipant;
use App\District;
use App\EducationLevel;
use App\Http\Controllers\Controller;
use App\Jobs;
use App\Qualification;
use App\SkaClassification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    public function registration($id)
    {
        $certification = Certification::findOrFail($id);
        $jobs = Jobs::get()->pluck('name', 'id');
        $districts = District::get()->pluck('name', 'id');
        $educationLevels = EducationLevel::get()->pluck('name', 'id');
        $skaClassifications = SkaClassification::get()->pluck('name', 'id');
        $qualifications = Qualification::get()->pluck('name', 'id');

        $data['title'] = 'Pendaftaran '. $certification->title;
        $data['certification'] = $certification;
        $data['jobs'] = $jobs;
        $data['districts'] = $districts;
        $data['educationLevels'] = $educationLevels;
        $data['skaClassifications'] = $skaClassifications;
        $data['qualifications'] = $qualifications;
        return view('certification.registration', $data);
    }

    public function registrationStore($id, Request $request)
    {
        $certification = Certification::findOrFail($id);
        try
        {
            $participant = CertificationParticipant::where('id_number', $request->nik)
                                                    ->first();
            if($participant)
            {
                return redirect()->back()->withErrors('Anda sudah pernah mendaftar untuk sertifikasi ini.');
            }

            DB::transaction(function () use ($request, $certification)
            {
                $participant = new CertificationParticipant();
                $participant->certification_id = $certification->id;
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
                $participant->ska_classification_id = $request->ska_classification_id;
                $participant->sub_classification_code = $request->sub_classification_code;
                $participant->sub_classification_name = $request->sub_classification_name;
                $participant->qualification_id = $request->qualification_id;
                $participant->save();

                $file = $request->school_diploma_path;
                if($file)
                {
                    $config['disk'] = 'upload';
                    $config['upload_path'] = '/certification/'.$certification->id;
                    $config['public_path'] = env('APP_URL') . '/certification/'.$certification->id;

                    // create directory if doesn't exist
                    if (!Storage::disk($config['disk'])->has($config['upload_path']))
                    {
                        Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                    }

                    // upload file if valid
                    if ($file->isValid())
                    {
                        $filename = $file->getClientOriginalName();
                        $oldPath = $participant->school_diploma_path;

                        Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);

                        // delete old file
                        Storage::disk($config['disk'])->delete($oldPath);

                        // save new path
                        $participant->school_diploma_path = $config['disk'].$config['upload_path'].'/'.$filename;
                        $participant->save();
                    }
                }

                $file = $request->work_experience_path;
                if($file)
                {
                    $config['disk'] = 'upload';
                    $config['upload_path'] = '/certification/'.$certification->id;
                    $config['public_path'] = env('APP_URL') . '/certification/'.$certification->id;

                    // create directory if doesn't exist
                    if (!Storage::disk($config['disk'])->has($config['upload_path']))
                    {
                        Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                    }

                    // upload file if valid
                    if ($file->isValid())
                    {
                        $filename = $file->getClientOriginalName();
                        $oldPath = $participant->work_experience_path;

                        Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);

                        // delete old file
                        Storage::disk($config['disk'])->delete($oldPath);

                        // save new path
                        $participant->work_experience_path = $config['disk'].$config['upload_path'].'/'.$filename;
                        $participant->save();
                    }
                }

                $file = $request->id_card_path;
                if($file)
                {
                    $config['disk'] = 'upload';
                    $config['upload_path'] = '/certification/'.$certification->id;
                    $config['public_path'] = env('APP_URL') . '/certification/'.$certification->id;

                    // create directory if doesn't exist
                    if (!Storage::disk($config['disk'])->has($config['upload_path']))
                    {
                        Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                    }

                    // upload file if valid
                    if ($file->isValid())
                    {
                        $filename = $file->getClientOriginalName();
                        $oldPath = $participant->id_card_path;

                        Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);

                        // delete old file
                        Storage::disk($config['disk'])->delete($oldPath);

                        // save new path
                        $participant->id_card_path = $config['disk'].$config['upload_path'].'/'.$filename;
                        $participant->save();
                    }
                }

                $file = $request->npwp_path;
                if($file)
                {
                    $config['disk'] = 'upload';
                    $config['upload_path'] = '/certification/'.$certification->id;
                    $config['public_path'] = env('APP_URL') . '/certification/'.$certification->id;

                    // create directory if doesn't exist
                    if (!Storage::disk($config['disk'])->has($config['upload_path']))
                    {
                        Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                    }

                    // upload file if valid
                    if ($file->isValid())
                    {
                        $filename = $file->getClientOriginalName();
                        $oldPath = $participant->npwp_path;

                        Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);

                        // delete old file
                        Storage::disk($config['disk'])->delete($oldPath);

                        // save new path
                        $participant->npwp_path = $config['disk'].$config['upload_path'].'/'.$filename;
                        $participant->save();
                    }
                }

                $file = $request->statement_letter_path;
                if($file)
                {
                    $config['disk'] = 'upload';
                    $config['upload_path'] = '/certification/'.$certification->id;
                    $config['public_path'] = env('APP_URL') . '/certification/'.$certification->id;

                    // create directory if doesn't exist
                    if (!Storage::disk($config['disk'])->has($config['upload_path']))
                    {
                        Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                    }

                    // upload file if valid
                    if ($file->isValid())
                    {
                        $filename = $file->getClientOriginalName();
                        $oldPath = $participant->statement_letter_path;

                        Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);

                        // delete old file
                        Storage::disk($config['disk'])->delete($oldPath);

                        // save new path
                        $participant->statement_letter_path = $config['disk'].$config['upload_path'].'/'.$filename;
                        $participant->save();
                    }
                }

                $file = $request->cv_path;
                if($file)
                {
                    $config['disk'] = 'upload';
                    $config['upload_path'] = '/certification/'.$certification->id;
                    $config['public_path'] = env('APP_URL') . '/certification/'.$certification->id;

                    // create directory if doesn't exist
                    if (!Storage::disk($config['disk'])->has($config['upload_path']))
                    {
                        Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                    }

                    // upload file if valid
                    if ($file->isValid())
                    {
                        $filename = $file->getClientOriginalName();
                        $oldPath = $participant->cv_path;

                        Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);

                        // delete old file
                        Storage::disk($config['disk'])->delete($oldPath);

                        // save new path
                        $participant->cv_path = $config['disk'].$config['upload_path'].'/'.$filename;
                        $participant->save();
                    }
                }
                
                $file = $request->photo_path;
                if($file)
                {
                    $config['disk'] = 'upload';
                    $config['upload_path'] = '/certification/'.$certification->id;
                    $config['public_path'] = env('APP_URL') . '/certification/'.$certification->id;

                    // create directory if doesn't exist
                    if (!Storage::disk($config['disk'])->has($config['upload_path']))
                    {
                        Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
                    }

                    // upload file if valid
                    if ($file->isValid())
                    {
                        $filename = $file->getClientOriginalName();
                        $oldPath = $participant->photo_path;

                        Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);

                        // delete old file
                        Storage::disk($config['disk'])->delete($oldPath);

                        // save new path
                        $participant->photo_path = $config['disk'].$config['upload_path'].'/'.$filename;
                        $participant->save();
                    }
                }
            });
            return redirect()->back()->withSuccess('Pendaftaran berhasil');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors('Terjadi kesalahan. silahkan kontak admin');
        }
    }
}