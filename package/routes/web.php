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

Route::get('/','YoutubeController@index');
Route::post('/youtube','YoutubeController@add');
Route::get('/test','YoutubeController@teste');
Auth::routes();

Route::get('/home', 'YoutubeController@index')->name('home');
Route::get('/category','YoutubeController@cata');
Route::post('/cata','YoutubeController@new_cata');
Route::get('/cata/{id}','YoutubeController@single_cata');
Route::post('/cata/edit','YoutubeController@edit_cata');
Route::post('/videos/edit','YoutubeController@edit_videos');
Route::get('/videos/delete/{id}','YoutubeController@delete_videos');
Route::get('/cata/delete/{id}','YoutubeController@delete_cata');
