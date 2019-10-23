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

Route::get('/token', 'Api\TokenController@welcome');
Route::get('/token/{event}', 'Api\TokenController@event');
Route::get('/token/{event}/files', 'Api\TokenController@files');
