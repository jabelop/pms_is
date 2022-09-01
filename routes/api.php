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


// user routes
Route::post('user', 'App\Http\Controllers\UserController@postUser');
Route::get('users', 'App\Http\Controllers\UserController@getUsers');

// project routes
Route::post('project', 'App\Http\Controllers\ProjectController@postProject');
Route::put('project-user', 'App\Http\Controllers\ProjectController@addUser');
Route::get('projects', 'App\Http\Controllers\ProjectController@getProjects');

// activity routes
Route::post('activity', 'App\Http\Controllers\ActivityController@postActivity');
Route::put('activity-user', 'App\Http\Controllers\ActivityController@addUser');
Route::get('activities', 'App\Http\Controllers\ActivityController@getActivities');

// incidence routes
Route::post('incidence', 'App\Http\Controllers\IncidenceController@postIncidence');
Route::get('incidences', 'App\Http\Controllers\IncidenceController@getIncidences');


