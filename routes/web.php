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

Route::get('/', 'TaskController@index');
Route::get('/magnet/{name}', 'TaskController@magnet');
Route::get('/video/{name}', 'TaskController@video');
Route::get('/content/{type}/{id}', 'TaskController@play');
Route::get('/dplayer/{id}', 'TaskController@dplayer');
