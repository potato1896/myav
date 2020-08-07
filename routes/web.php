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
Route::get('/magnetlist/{name}', 'TaskController@magnetlist');
Route::get('/magnetlist/{name}/{type}', 'TaskController@magnetlistwhere');
Route::get('/search','TaskController@search');
Route::get('/tag/{type}/{tag}','TaskController@tag');
Route::get('/content/{type}/{id}', 'TaskController@play');
Route::get('/player/{id}', 'TaskController@player');
Route::get('/iplayer/{id}', 'TaskController@iplayer');
Route::get('/rand/{id}/{catalog}', 'TaskController@rand');
Route::get('/ajaxrand/{id}/{catalog}', 'TaskController@ajaxrand');
Route::get('/pic/{id}', 'TaskController@pic');
Route::get('/pic2/{id}', 'TaskController@pic2');
Route::get('/piclist/{type}', 'TaskController@piclist');
Route::get('/piclist2/{type}', 'TaskController@piclist2');
Route::get('/cartoon', 'TaskController@cartoonlist');
Route::get('/cartoon/{id}', 'TaskController@cartoon');
Route::get('/videolist/{type}', 'TaskController@videolist');
Route::get('/star/{id}', 'TaskController@star');
Route::get('/vr', 'TaskController@vr');
Route::get('/novelist/{catalog}', 'TaskController@novelist');
Route::get('/novel/{id}', 'TaskController@novel');
