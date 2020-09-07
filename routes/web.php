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

Route::get('/home', 'PostsController@index')->name('posts.index');
Route::get('/posts/new' , 'PostsController@create')->name('posts.new');
Route::post('/posts' , 'PostsController@store')->name('posts.store');
Route::get('/posts/{post}/edit' , 'PostsController@edit')->name('posts.edit')->where('post', '[0-9]+');
Route::patch('/posts/{post}' , 'PostsController@update')->name('posts.update');
Route::get('/posts/{post}/delete' , 'PostsController@destroy')->name('posts.delete')->where('post', '[0-9]+');

Route::get('/users/{user}' , 'UsersController@show')->name('users.show')->where('user', '[0-9]+');
Route::get('/users/edit' , 'UsersController@edit')->name('users.edit');
Route::post('/users/update' , 'UsersController@update')->name('users.update');

Route::get('/guest', 'Auth\LoginController@authenticate')->name('login.guest');

Route::get('/likes/{post}' , 'LikesController@store')->name('likes.new')->where('post', '[0-9]+');
Route::get('/likes/{like}/delete' , 'LikesController@destroy')->name('likes.delete')->where('like', '[0-9]+');

Route::post('/comments' , 'CommentsController@store')->name('comments.new');
Route::get('/comments/{comment}/delete' , 'CommentsController@destroy')->name('comments.delete')->where('comment', '[0-9]+');
