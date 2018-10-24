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

Route::get('/controlReplica', function () {
    return view('controlReplica');
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
Route::get('countriesInProgress', 'OlapController@getDataDbsInProgress');
Route::get('dbIfxCore', 'ControlReplicaController@getDbIfxCore');
Route::get('tablesIfxCore', 'ControlReplicaController@getTablesIfxCore');
Route::get('fieldsIfxCore', 'ControlReplicaController@getFieldsIfxCore');
Route::get('fieldsTDIfxCore', 'ControlReplicaController@getFieldsTDIfxCore');
Route::get('countRowsIfxCore', 'ControlReplicaController@getCountRowsIfxCore');
Route::get('dbWeightIfxCore', 'ControlReplicaController@getdbWeightIfxCore');