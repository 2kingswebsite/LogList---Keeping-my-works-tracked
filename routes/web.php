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

Route::get('/', function () {
    return view('home');
});


//---------[Profile]-----------//
Route::get('/user','ProfileController@index')->name('profile.index');



//---------[Project]--------------//
Route::get('/project_user_{id}','ProjectController@index')->name('project.index');
Route::get('/project/add','ProjectController@add')->name('project.add');
Route::get('/project/create','ProjectController@create')->name('project.create');


//---------[Collab]-------------//
Route::get('/generate_token','ProfileController@token')->name('project.collab');
Route::get('/generate_token_again','ProfileController@token2')->name('project.collabOther');
Route::get('/add_collaborator','ProfileController@addCollab')->name('project.add.Collab');
Route::get('/get_details_collab','ProfileController@getDetailsCollab')->name('project.getdetails.Collab');
Route::get('/request_collab_{id}_for_{project_id}','ProfileController@requestCollab')->name('project.request.Collab');


//---------[Task]--------------//
Route::get('/project/task/create','TaskController@create')->name('task.create');
Route::post('/project/task/store','TaskController@store')->name('task.store');
Route::get('/project/task_{id}','TaskController@edit')->name('task.edit');
Route::put('/project/task_{id}/update','TaskController@update')->name('task.update');
Route::delete('/project/task_{id}/destroy','TaskController@destroy')->name('task.destroy');





Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
