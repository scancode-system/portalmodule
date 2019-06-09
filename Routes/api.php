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

Route::get('/portal', function (Request $request) {
    Route::get('/client/data', 'Api\ClientController@data');
	Route::get('/client/download', 'Api\ClientController@download');
});


