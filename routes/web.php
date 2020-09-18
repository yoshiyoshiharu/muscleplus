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
})->name('welcome');

Route::get('/policy', function () {
    return view('policy');
})->name('policy');
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

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
Route::get('/users/delete' , 'UsersController@destroy')->name('users.delete');

Route::get('/guest', 'Auth\LoginController@authenticate')->name('login.guest');

Route::get('/likes/{post}' , 'LikesController@process')->name('likes')->where('post', '[0-9]+');

Route::post('/comments' , 'CommentsController@store');
Route::post('/comments/{comment}' , 'CommentsController@destroy')->where('comment', '[0-9]+');

Route::get('/ajax/tags/{user}', 'Ajax\TagsController@index')->where('user', '[0-9]+');

Route::get('/login/facebook' , 'Auth\LoginController@redirectToFacebook')->name('login.facebook');
Route::get('/login/facebook/callback' , 'Auth\LoginController@handleFacebookCallback');
