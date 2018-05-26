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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();
Route::resource('/todolist', 'TodolistController');
Route::resource('/todo', 'TodoController');

Route:: post('creattodolist', 'TodolistController@store')->name('todolist');
Route::get( '/vueitems', 'TodolistController@show');
Route::get('/home', 'TodolistController@index')->name('home');
//Route::get( '/todolist/{id}', 'TodolistController@destroy');
Route:: get('/todolist/list', 'TodolistController@index')->name('todolist1');
Route::patch('/todolist/{id}', 'TodolistController@update');

Route::get( '/todos/{id}', 'TodoController@show');
Route::patch('/todo/{id}', 'TodoController@update');

Route::get('/todolist', 'TodoController@index');
Route::get('/createtodo', 'TodoController@createTodo');
Route:: post('/todo/store', 'TodoController@store')->name('storetodo');


