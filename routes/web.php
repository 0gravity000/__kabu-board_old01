<?php

use App\Events\CheckKabuValue;

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
	//event(new CheckKabuValue());
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/Meigaras','MeigarasController@index');
Route::get('/Meigaras/reload','MeigarasController@reload');

Route::get('/Realtimes','RealtimesController@index');
Route::get('/Realtimes/value','RealtimesController@index_value');
Route::get('/Realtimes/changerate','RealtimesController@index_changerate');

Route::get('/Realtimes/update','RealtimesController@update');
Route::get('/Realtimes/create','RealtimesController@create');
Route::get('/Realtimes/reset','RealtimesController@reset');
Route::post('/Realtimes','RealtimesController@store');
Route::post('/Realtimes/config_value','RealtimesController@config_value');
Route::post('/Realtimes/configed_value','RealtimesController@configed_value');
Route::post('/Realtimes/config_changerate','RealtimesController@config_changerate');
Route::post('/Realtimes/configed_changerate','RealtimesController@configed_changerate');

Route::post('/Realtimes/auto', 'RealtimesController@auto');

Route::get('/Analyses','AnalysesController@index');
//Route::get('/Analyses/Daily','AnalysesController@create');
