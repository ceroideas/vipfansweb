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

Route::post('/users/filter' , 'usersController@filter');

// Api routes
Route::get('/users/all' , 'apiController@getAllUsers');
Route::post('/users/add/magnetism/{id}' , 'apiController@addMagnetism');
Route::post('/users/add' , 'apiController@addShowUser');
