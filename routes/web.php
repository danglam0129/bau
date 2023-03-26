<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/','App\Http\Controllers\HomeController@list');
route::get('movies','App\Http\Controllers\MovieController@list')->name('movies');
Route::get('movies/{slug}','App\Http\Controllers\MovieController@detail');
Route::get('movies/{slug}/watch','App\Http\Controllers\MovieController@watch');
Route::get('search','App\Http\Controllers\SearchController@search')->name('search');
Route::get('stars','App\Http\Controllers\StarController@list')->name('stars');
Route::get('stars/{slug}','App\Http\Controllers\StarController@detail');
Route::get('series','App\Http\Controllers\SerieController@list')->name('series');
Route::get('series/{slug}','App\Http\Controllers\SerieController@detail');
Route::get('series/{slug}/{seasonslug}','App\Http\Controllers\SerieController@season');
Route::get('news','App\Http\Controllers\NewsController@list');

Route::get('toptop/{idtmdb}', 'App\Http\Controllers\MovieController@index');
Route::get('tutu/{idtmdb}','App\Http\Controllers\SerieController@index');

// Route::get('update','App\Http\Controllers\MovieController@update');
Route::get('{slug}','App\Http\Controllers\NewsController@post');




