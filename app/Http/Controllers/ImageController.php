<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
	public function upload(Request $request)
	{
		$newPath = null;
		if ($request->upload)
        {
            //get the photo data and new path
            $file = $request->upload;
			$now = Carbon::now();
            $folder = 'post';
            if($request->folder)
            {
                $folder = $request->folder;
            }
            $folderPath = 'uploads/'.$folder.'/'.$now->format('Y').'/'.$now->format('m').'/'.$now->format('d').'/';
            $fileName = $file->getClientOriginalName();
            // $newPath = $folderPath. uniqid() . '.' . $file->getClientOriginalExtension(); // upload path
            $newPath = $folderPath. $fileName; // upload path

            // create the directory if its not there, this is a must since intervention did not create the directory automatically
            File::exists($folderPath) or File::makeDirectory($folderPath, 0755, true);

            // resize and save the uploaded file
            Image::make($file)
					// ->resize(800, null, function ($constraint) {
					// 	$constraint->aspectRatio();
					// 	$constraint->upsize();
					// })
                    ->save($newPath);
        }
        return response()->json(
            [
                'url' => asset($newPath),
                'location' => asset($newPath),
            ]
        );
	}
    
	public function uploadImagePage(Request $request)
	{
		$newPath = null;
		if ($request->upload)
        {
            //get the photo data and new path
            $file = $request->upload;
			$now = Carbon::now();
            $folderPath = 'uploads/pages/'.$now->format('Y').'/'.$now->format('m').'/'.$now->format('d').'/';
            $fileName = $file->getClientOriginalName();
            // $newPath = $folderPath. uniqid() . '.' . $file->getClientOriginalExtension(); // upload path
            $newPath = $folderPath. $fileName; // upload path

            // create the directory if its not there, this is a must since intervention did not create the directory automatically
            File::exists($folderPath) or File::makeDirectory($folderPath, 0755, true);

            // resize and save the uploaded file
            Image::make($file)
					// ->resize(800, null, function ($constraint) {
					// 	$constraint->aspectRatio();
					// 	$constraint->upsize();
					// })
                    ->save($newPath);
        }
        return response()->json(
            [
                'url' => asset($newPath),
                'location' => asset($newPath),
            ]
        );
	}
}
