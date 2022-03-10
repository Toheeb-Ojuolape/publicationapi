<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PublicationsApiController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




 
// fetch all publications
Route::get('/publications',[PublicationsApiController::class,'index']);
 
// fetch publication of single author
Route::post('/publications',[PublicationsApiController::class,'single']);

//fetch single publication to view
Route::get('/publications/{id}',[PublicationsApiController::class,'singlepub']);


// update publication
Route::put('/publications/{id}', [PublicationsApiController::class,'update']);

// create a new publication
Route::post('/create',[PublicationsApiController::class,'create']);

// fetch contributions to publication
Route::post('/fetchcontributions',[PublicationsApiController::class,'fetch']);


//delete publication
Route::delete('/publications/{id}',[PublicationsApiController::class,'delete']);


//For Contributors

//get all the contributions 
Route::get('/contributors',[PublicationsApiController::class,'contributors']);

//get single contribution for viewing
Route::get('contributors/{id}',[PublicationsApiController::class,'singlecontributor']);

//submit a contributions
Route::post('/contribute',[PublicationsApiController::class,'contribute']);


//reject/delete contribution
Route::delete('/contributors/{id}', [PublicationsApiController::class,'contributordelete']);




//for financing and contributor wallet

//when reader buys book
Route::post('/finance',[PublicationsApiController::class,'buybook']);

//get walletBalance of contributor and publisher
Route::post('/balance',[PublicationsApiController::class,'balance']);

//get money from book sales
// Route::get('/finance',[PublicationsApiController::class,'getmoney']);

//delete money from finance table
Route::delete('/finance',[PublicationsApiController::class,'deletemoney']);

//get books bought by reader
Route::post('/reader',[PublicationsApiController::class,'reader']);

//get all the readers of a book
Route::post('/getreaders',[PublicationsApiController::class,'getReaders']);

Route::post('/upload',[UploadController::class,'uploadFile'])->name('upload.uploadfile'); 


//send emails
Route::post('/mail',[MailController::class,'mail']);

