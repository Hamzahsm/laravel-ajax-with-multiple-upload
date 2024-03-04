<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; //no image
use App\Http\Controllers\ImageController; //with image
use App\Http\Controllers\AjaxUploadController; //with image v2
use App\Http\Controllers\AjaxUploadMultipleImageController; //with muliple upload images


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * route resource posts
 */
Route::resource('/posts', PostController::class); //with no image

//failed upload photo
Route::get('photo', [ImageController::class, 'index']);
// Route::post('photo', [ImageController::class, 'save']); //with image
Route::get('photo', [HttpController::class, 'save']); //with image


//success single upload photo
Route::get('image-preview', [AjaxUploadController::class, 'index']);
Route::post('upload', [AjaxUploadController::class, 'store']);


//multiple images files
Route::get('multiple-image-preview', [AjaxUploadMultipleImageController::class, 'index']);

Route::post('upload-multiple-image-ajax', [AjaxUploadMultipleImageController::class, 'saveUpload']);