<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/conductores', 'ConductorController@index')->name('conductores');

Route::get('servicios-dia/{fecha?}', 'ServicioController@indexFecha');
Route::get('servicios-conductor/{conductor?}', 'ServicioController@indexConductor');

Route::get('/conductores/excel', 'ConductorController@export');
Route::get('/conductores/csv', 'ConductorController@exportCsv');
Route::get('/conductores/pdf', 'ConductorController@pdf');
Route::resource('conductores', 'ConductorController');


Route::resource('tipos-servicios', 'TiposServicioController');

Route::resource('servicios', 'ServicioController');

Route::get('documentos-conductor/{id}', 'UploadImagesController@create')->name('documentos');
Route::post('/images-save', 'UploadImagesController@store');
Route::post('/images-delete', 'UploadImagesController@destroy');
Route::get('/images-show', 'UploadImagesController@index');
//Route::get('/conductores', 'ConductoresController@index')->name('user')->middleware('auth');
//Route::post('/conductores', 'ConductoresController@addConductor')->name('conductor_add')->middleware('auth');

