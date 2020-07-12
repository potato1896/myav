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
Route::get('/magnet/{name}/{type}', 'TaskController@magnetwhere');

Route::get('/content/{type}/{id}', 'TaskController@play');
Route::get('/player/{id}', 'TaskController@player');
Route::get('/iplayer/{id}', 'TaskController@iplayer');
Route::get('/rand/{id}/{catalog}', 'TaskController@rand');
Route::get('/pic/{id}', 'TaskController@pic');
Route::get('/piclist/{type}', 'TaskController@piclist');
Route::get('/videolist/{type}', 'TaskController@videolist');
