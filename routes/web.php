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

Route::get('/', 'HomeController@home' );

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


Route::get('home', 'HomeController@show')->name('home');
Route::view('about_us', 'pages.about_us');
Route::get('members/{id}', 'MemberController@show')->name('members'); //TODO: change the controller function
Route::get('members/{id}/settings', 'MemberController@edit')->name('settings');
Route::post('members/{id}', 'MemberController@update')->name('members.update');
Route::post('members/{id}/password', 'MemberController@updatePassword')->name('members.update.password');
Route::post('members/{id}/delete', 'MemberController@deactivate')->name('members.deactivate');


Route::get('questions/{id}', 'QuestionController@show');
Route::get('questions', 'QuestionController@create')->name('add.questions');
Route::post('questions', 'QuestionController@store')->name("store.question");


// API
Route::post('api/answers', 'ResponseController@create');


Route::post('api/comments', 'CommentController@create');