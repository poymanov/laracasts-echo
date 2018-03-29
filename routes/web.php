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

use App\Events\TaskCreated;
use App\Events\UpdateOrderStatus;
use App\Task;

//class Order {
//
//    public $id;
//
//    public function __construct($id)
//    {
//        $this->id = $id;
//    }
//}

Route::get('/', 'HomeController@index')->name('home');
Route::get('/projects/{project}', 'ProjectsController@show')->name('projects.show');


//Route::get('/tasks', function () {
//    return Task::all()->pluck('body');
//});
//
//Route::post('/tasks', function () {
//    $task = Task::forceCreate(request(['body']));
//
//    TaskCreated::dispatch($task);
//});
//
//
//
////Route::get('/update', function () {
////    UpdateOrderStatus::dispatch(new Order(1));
////});
//
//
Auth::routes();
//

