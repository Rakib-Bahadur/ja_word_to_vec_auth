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


Auth::routes();
Route::get('/','PagesController@index');
Route::get('/home', 'DashboardController@index')->name('dashboard');
Route::get('/search', 'PagesController@searchResults')->name('search');
Route::resource('posts', 'PostsController');
