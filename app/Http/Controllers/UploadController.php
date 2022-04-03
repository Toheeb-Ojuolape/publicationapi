<?php

namespace App\Http\Controllers;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Helpers\APIHelpers;

class UploadController extends Controller
{
   public function uploadForm(){
       return view('upload');
   }

   public function uploadFile(Request $request)
   {
    $file = $request->file('file');
    $filename = $file->getClientOriginalName();
    $file->storeAs('files/', $filename,"s3");
    $response = APIHelpers::createAPIResponse(false, 200,'',$filename);
    return response()->json($response,200); 
   }
}
