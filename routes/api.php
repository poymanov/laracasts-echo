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

Route::get('/projects', 'ProjectsController@index')->name('api.projects.index');
Route::post('/projects', 'ProjectsController@store')->name('api.projects.store');

Route::get('/projects/{project}/tasks', 'TasksController@index')->name('api.tasks.index');
Route::post('/projects/{project}/tasks', 'TasksController@store')->name('api.tasks.store');