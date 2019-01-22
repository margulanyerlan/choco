<?php

use Illuminate\Http\Request;

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
Route::get('/taxes', 'TaxeController@index');
Route::post('/taxes', 'TaxeController@store');
Route::get('/taxes/{rull_id}', 'TaxeController@getByRullId');
Route::post('/taxes/delete/{id}', 'TaxeController@delete');

Route::get('/rules', 'RuleController@index');
Route::get('/rules/{id}', 'RuleController@show');
Route::post('/rules', 'RuleController@store');
Route::post('/rules/update','RuleController@update');
Route::post('/rules/delete/{id}','RuleController@delete');
Route::post('/rules/calculate', 'RuleController@calculate');

Route::get('/fares', 'FareController@index');
Route::get('/fares/{rull_id}', 'FareController@getByRullId');
Route::post('/fares', 'FareController@store');
Route::post('/fares/{id}', 'FareController@update');
Route::post('/fares/delete/{id}', 'FareController@delete');


Route::post('/rules/check', 'RuleController@check');





