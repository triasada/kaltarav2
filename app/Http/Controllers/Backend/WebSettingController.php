<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\WebSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WebSettingController extends Controller
{
    public function edit()
    {
        $this->authorize('edit web-stting', Auth::user());
        try
        {
            $webSettings = WebSetting::all();
            $data['title'] = 'Web Setting';
            $data['webSettings'] = $webSettings;
            return view('websetting.edit', $data);
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $setting = WebSetting::findOrFail($request->id);
            $setting->value = $request->value;
            $setting->save();
            DB::commit();
            return redirect()->back()->withSuccess('Data berhasil dirubah');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            DB::rollBack();
            return redirect()->back()->withErrors($message);
            // return response()->json(['message' => $message], 500);
        }
    }
}
