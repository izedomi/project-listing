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

Route::get('/', 'PublicController@index');
Route::get('/project_info/{id}', 'PublicController@show');
Route::post('/search-result', 'PublicController@search');

Auth::routes();

Route::get('admin/home', 'HomeController@index')->name('home');
Route::get('admin/index', 'ProjectController@index');
Route::get('admin/{id}/delete', 'ProjectController@delete');
Route::Resource('admin', 'ProjectController');