<?php

use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryBooksController;
use App\Http\Controllers\lessonLibraryController;
use App\Http\Controllers\PublishingController;
use Illuminate\Http\Request;
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



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/library', [LibraryController::class, 'library']);
Route::get('/library/{id}', [LibraryController::class, 'viewbook']);
        
Route::get('/authors',[AuthorController::class,'index']);
Route::get('/authors/{id}', [AuthorController::class,'show']);

Route::get('/publishings', [PublishingController::class,'index']);
Route::get('/publishings/{id}', [PublishingController::class,'show']);

Route::get('/categories', [CategoryBooksController::class,'index']);
Route::get('/categories/{id}', [CategoryBooksController::class,'show']);

Route::get('sciences/{id}', [lessonLibraryController::class, 'statistic']);

