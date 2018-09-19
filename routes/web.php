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
    return view('dashboard');
});

Route::Resource('countries', 'CountryController');
Route::Resource('tp_persons', 'TpPersonController');
Route::Resource('persons', 'PersonController');
Route::Resource('dbs', 'DbController');

Route::get('dbArrived', 'OlapController@getDbArrived');
Route::get('dbProcessed', 'OlapController@getDbProcessed');
Route::get('dbInProgress', 'OlapController@getDbInProgress');
Route::get('prEfficiency', 'OlapController@getPrEfficiency');
Route::get('fltProduct', 'OlapController@getFltProduct');
Route::get('fltYear', 'OlapController@getFltYear');
Route::get('fltMonth', 'OlapController@getFltMonth');
Route::get('fltCountry', 'OlapController@getFltCountry');
Route::get('maxMonthCountry', 'OlapController@getDataMaxMonthContry');
Route::get('cantMonth', 'OlapController@getDataMonthCant');
Route::get('efecAnalyst', 'OlapController@getDataEfecAnalyst');