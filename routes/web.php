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

Route::get('/', function () {return redirect('home');});

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


Route::get('home', 'HomeController@show')->name('home');
Route::view('about_us', 'pages.about_us');
Route::get('members/{id}', 'MemberController@show')->name('members'); //TODO: change the controller function
Route::get('members/{id}/settings', 'MemberController@edit');
Route::post('members/{id}', 'MemberController@update')->name('members.update');
Route::post('members/{id}/password', 'MemberController@updatePassword')->name('members.update.password');


Route::get('questions/add', 'QuestionController@create');
Route::post('questions/add', 'QuestionController@store')->name("store.question");