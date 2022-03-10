<?php

namespace App\Http\Controllers;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;

class UploadController extends Controller
{
   public function uploadForm(){
       return view('upload');
   }

   public function uploadFile(Request $request)
   {
    $slugify = new Slugify();
    $fileName = $slugify->slugify($request->file->getClientOriginalName());
    $path =  $request->file->storeAs('public', $fileName);
    $photoURL = url('/'.$fileName);
    return response()->json(['url' => $photoURL], 200);
   }
}
