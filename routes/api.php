<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth.apikey')
    ->namespace("App\Http\Controllers\Api")
    ->group(function(){
    Route::get('/users', 'UserController@index');
    Route::get('/states', 'GeoControler@getStates');
    Route::get('/cities', 'GeoControler@getCities');
    Route::resource('person', 'PersonController')->except(['create', 'edit']);
    Route::post('/sync', 'SyncController@sync');
});
