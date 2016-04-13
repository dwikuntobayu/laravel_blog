<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// ini untuk setup default homepage
Route::get('/', 'ArticlesController@index');
// ini untuk setup CRUD path url
Route::resource('articles', 'ArticlesController');
Route::resource('comments', 'CommentsController');
Route::resource('products', 'ProductsController');
Route::resource('users', 'UsersController', ['except' => array('index', 'destroy')]);
Route::resource('sessions', 'SessionsController', ['only' => array('create', 'store')]);
Route::get('/logout', 'SessionsController@logout');
