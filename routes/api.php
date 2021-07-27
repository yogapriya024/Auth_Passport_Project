<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DeviceController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[UserController::class,'registeration']);
Route::post('/login',[UserController::class,'login'])->name('login');
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function() {
    
    //FileUpload
    Route::get('/get-file/{id?}',[FileUploadController::class,'getFile']);
    Route::post('/fileupload',[FileUploadController::class,'fileupload']);
    Route::post('/update-file/{id}',[FileUploadController::class,'updatefile']);
    Route::delete('/delete-file/{id}',[FileUploadController::class,'deletefile']);
    
    //Post
    Route::apiResource('/post', PostController::class);
    
    //Author
    Route::apiResource('/authors',AuthorController::class);

    //Book
    Route::apiResource('/books',BookController::class);
    
    //Device
    Route::apiResource('/devices',DeviceController::class);

    //Logout
    Route::post('/logout',[UserController::class,'logout']);
});
//Route::middleware('auth:api')->get('/get-blog/{id?}',[BlogController::class,'getBlog']);
//Route::middleware('auth:api')->post('/add-blog',[BlogController::class,'addBlog']);
//Route::middleware('auth:api')->put('/update-blog',[BlogController::class,'updateBlog']);
//Route::middleware('auth:api')->delete('/delete-blog/{id}',[BlogController::class,'deleteBlog']);
//Route::middleware('auth:api')->get('/search-blog/{title}',[BlogController::class,'searchBlog']);


