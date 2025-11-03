<?php

use App\Http\Controllers\HemisAuthController;
use Doctrine\DBAL\Schema\Index;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/','MainController@index');

Route::post('/ga3hg123gh12g3hj12g3hj12g3hjg21h33gv31gv3g21v/1316299242:AAGS80Gr9NZ3xJBNhg7FSHla2xTvKPFUNP8/webhook', 'TgController@hook')->name('tg.hook');
Route::get('/{token}/webhook', function () {
    return view('welcome');
});
 Route::get('/library', 'MainController@library')->name('library');
 Route::get('/pdf-view/{id}',  'MainController@pdf')->name('pdf.viewer');
 Route::get('/pdf-view/manual/{id}',  'MainController@pdfManual')->name('pdf.viewer-manual');

Route::get('/library_manual/{id?}', 'lessonLibraryController@library')->name('lesson-library');
Route::get('/library_manual/view/{id}', 'lessonLibraryController@viewbook')->name('lesson-library.viewbook');

Route::get('/library/{id}', 'MainController@viewbook')->name('viewbook');
Route::get('/library/download/{id}', 'MainController@download')->name('download');
Route::get('/page/{slug}', 'MainController@page')->name('page');
Route::get('/newsview/{slug}', 'MainController@viewnews')->name('viewnews');
Route::get('/news', 'MainController@newsall')->name('newsall');
Route::get('/search', 'MainController@searchContent');
Route::post('/buyurtma', 'MainController@store')->name('kitobbuyurtma');


Route::group(['middleware' => 'language'], function () {

    Route::get('/', 'MainController@index');
});

Route::get('/login', 'LoginController@index')->name('loginstudent');
Route::post('/store-login', 'LoginController@store')->name('loginstudent-to-database');
Route::post('/store-employee-login', 'LoginController@employee')->name('loginemployee-to-database');



Route::get('/logout', 'LoginController@logout')->name('logout-student');




Route::get('/hemis/student', 'HemisAuthController@index')->name('hemis.web.student');
Route::get('/hemis/employee', 'HemisAuthController@employee')->name('hemis.web.employee');


