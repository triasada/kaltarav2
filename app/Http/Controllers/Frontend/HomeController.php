<?php

namespace App\Http\Controllers\Frontend;

use App\Certification;
use App\Content;
use App\ExpertData;
use App\Http\Controllers\Controller;
use App\JobSeeker;
use App\ProjectJob;
use App\School;
use App\SkilledData;
use App\Training;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

class HomeController extends Controller
{
    public function index()
    {
//        dd('asu');
        $latestArticle = Content::typePost()
                                ->published()
                                ->whereHas('post', function ($query)
                                {
                                    return $query->categoryNews();
                                })
                                ->orderBy('published_at', 'desc')
                                ->take('4')
                                ->get();


        $galleries = Content::typeGallery()
                            ->published()
                            ->has('gallery')
                            ->orderBy('published_at', 'desc')
                            ->take('3')
                            ->get();

        $announcements = Content::typePost()
                                ->published()
                                ->whereHas('post', function ($query)
                                {
                                    return $query->categoryAnnouncement();
                                })
                                ->orderBy('published_at', 'desc')
                                ->take('6')
                                ->get();
        $data['title'] = 'Home';
        $data['latestArticle'] = $latestArticle;
        $data['galleries'] = $galleries;
        $data['announcements'] = $announcements;

        return view('landing', $data);
    }

    public function registration()
    {
        $certifications = Certification::active()
                                        ->orderBy('registration_start_date', 'desc')
                                        ->get();

        $trainings = Training::active()
                            ->orderBy('registration_start_date', 'desc')
                            ->get();

        $data['title'] = "Registrasi";
        $data['certifications'] = $certifications;
        $data['trainings'] = $trainings;
        return view('registration', $data);
    }

    public function constructionWorker()
    {
        // $skt = SkilledData::get();
        // $ska = ExpertData::get();
        // $data['title'] = 'Tenaga Kerja Konstruksi';
        return redirect()->route('comingsoon');
    }

    public function comingsoon()
    {
        return view('comingsoon');
    }

    public function proyek()
    {
        $projectJobs = ProjectJob::get();
        $data['title'] = 'Proyek Pekerjaan';
        $data['projectJobs'] = $projectJobs;
        return view('project_job.index_public', $data);
    }

    public function school()
    {
        $schools = School::get();
        $data['title'] = 'Perguruan Tinggi';
        $data['schools'] = $schools;
        return view('school.index_public', $data);
    }

    public function jobSeeker()
    {
        $jobSeekers = JobSeeker::get();
        $data['title'] = 'Pencari Kerja Konstruksi';
        $data['jobSeekers'] = $jobSeekers;
        return view('job_seeker.index_public', $data);
    }
}
