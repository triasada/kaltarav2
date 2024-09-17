<?php

namespace App\Http\Controllers\Frontend;

use App\ExpertData;
use App\Http\Controllers\Controller;
use App\Jobs;
use App\SkaClassification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExpertDataController extends Controller
{
    public function index(Request $request)
    {
        	// DB::beginTransaction();
			try
			{
                $jobs = Jobs::with('expertDatas')
                            ->whereIn('id', [JOB_TENAGA_AHLI_KONSTRUKSI, JOB_TENAGA_TERAMPIL_KONSTRUKSI])
                            ->get();

                $skaClassifications = SkaClassification::all();
                $data['title'] = 'List Expert Data';
                $data['listData'] = $jobs;
                $data['ska'] = $skaClassifications;
                return view('expert_data.index_public', $data);
			}
			catch (\Throwable $th)
			{
				$message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
				Log::error($message);
				// DB::rollBack();
				return redirect()->back()->withErrors($message);
				// return response()->json(['message' => $message], 500);
			}
    }
}
