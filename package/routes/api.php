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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/','APIController@index');
Route::get('/single/{id}','APIController@index');
Route::get('/cata','APIController@cata');
#Route::post('/cata','APIController@new_cata');
Route::get('/cata/{id}','APIController@single_cata');
#Route::post('/cata/edit','APIController@edit_cata');
#Route::post('/videos/edit','APIController@edit_videos');
#Route::get('/videos/delete/{id}','APIController@delete_videos');
#Route::get('/cata/delete/{id}','APIController@delete_cata');
