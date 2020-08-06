<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cetak-sertifikat', function () {
    return view('cetak-sertifikat');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cetak-sertifikat', 'SertifikatController@form_cetak')->name('form-cetak-sertifikat');
Route::post('/cetak', 'SertifikatController@cetak')->name('cetak-sertifikat');

Route::get('/cek-sertifikat', 'SertifikatController@form_cek')->name('form-cek-sertifikat');
Route::post('/cek', 'SertifikatController@cek')->name('cek-sertifikat');

Route::group(['middleware' => ['auth']], function(){
    Route::post('/tambah-event', 'EventController@tambah')->name('tambah-event');
    Route::post('/update-event/{id}', 'EventController@update')->name('update-event');
    Route::get('/hapus-event/{id}', 'EventController@hapus')->name('hapus-event');
    Route::get('/detail-event/{id}', 'EventController@detail')->name('detail-event');

    Route::post('/import-peserta', 'PesertaController@import')->name('import-peserta');

});
