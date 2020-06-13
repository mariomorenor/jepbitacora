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
    return view('index');
});

Route::resource('cajeros','CajeroController')->except(['create','edit']);
Route::resource('zonas','ZonaController')->except(['create','edit']);
Route::resource('observaciones','ObservacionController')->only(['index','store','destroy']);
Route::resource('reportes','ReporteController')->only(['index','store','destroy','show']);
Route::get('pdf','ReporteController@PDF')->name('downloadPDF');