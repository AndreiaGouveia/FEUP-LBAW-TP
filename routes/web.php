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

// IF USER IS LOGGED IN AND IS ACCOUNT IS NOT ACTIVE/VISIBLE WE REDIRECT TO ACTIVE
Route::group(['middleware' => ['unactiveUser']], function () {

    //Default page
    Route::get('/', 'HomeController@home');

    //Static Pages
    Route::get('home', 'HomeController@show')->name('home');
    Route::view('about_us', 'pages.about_us');


    //Members
    Route::get('members/{id}', 'MemberController@show')->name('members');
    Route::get('members/{id}/content', 'MemberController@content')->name('member.content');
    Route::get('members/{id}/favorites', 'MemberController@favorites')->name('member.favorites');
    Route::get('members/{id}/settings', 'MemberController@edit')->name('settings');
    Route::post('members/{id}', 'MemberController@update')->name('members.update');
    Route::post('members/{id}/password', 'MemberController@updatePassword')->name('members.update.password');
    Route::post('members/{id}/deactivate', 'MemberController@deactivate')->name('members.deactivate');

    Route::group(['middleware' => ['admin']], function () {
        Route::post('/members/{id}/promote', 'MemberController@promote')->name('member.promote');
        Route::post('/members/{id}/demote', 'MemberController@demote')->name('member.demote');
        Route::post('/members/{id}/ban', 'MemberController@ban')->name('member.ban');
        Route::post('/members/{id}/unban', 'MemberController@unban')->name('member.unban');
    });

    //Search
    Route::get('search/{query}', 'HomeController@search')->name("search");
    Route::post('search', 'HomeController@postSearch')->name("search.post");
    Route::get('search/tags/{tag}', 'HomeController@searchTopic')->name("search.topic");
    Route::get('search/tags/{tag}/{filter}', 'HomeController@filteredSearchTopic')->name("filtered.search.topic");
    Route::get('search/{search}/{filter}', 'HomeController@filteredSearch')->name('filtered.search');

    //Questions
    Route::get('questions/{id}', 'QuestionController@show')->name("show.question");
    Route::get('questions', 'QuestionController@create')->name('add.questions')->middleware('auth');
    Route::post('questions', 'QuestionController@store')->name("store.question")->middleware('auth');

    Route::get('questions/{id}/edit', 'QuestionController@edit')->name("edit.question")->middleware('auth');
    Route::post('questions/{id}/edit', 'QuestionController@update')->name("update.question")->middleware('auth');

    // API
    Route::post('api/questions/{id}/answers', 'ResponseController@store');

    Route::post('api/publications/{id}/comments', 'CommentController@store');

    Route::post('api/publications/{id}/likes', 'LikesController@store');
    Route::post('api/publications/{id}/likes/delete', 'LikesController@destroy');

    Route::post('api/publications/{id}/favorites', 'FavoriteController@store');
    Route::post('api/publications/{id}/favorites/delete', 'FavoriteController@destroy');

    Route::post('api/publications/{id}/report', 'PublicationController@report');
    Route::post('api/publications/{id}/delete', 'PublicationController@delete');

    Route::get('publications/reports', 'PublicationController@view_reports')->name('reports')->middleware('authorizationReport');
    Route::post('/api/publications/{id}/report/resolved', 'PublicationController@resolve_report')->middleware('authorizationReport');


});


//ROUTES TO ACTIVATE ACCOUNT
Route::post('members/{id}/activate', 'MemberController@activate')->name('members.activate');
Route::get('members/{id}/activate', 'MemberController@show_activate')->name('members.show.activate');
Route::get('members/{id}/ban', 'MemberController@show_ban')->name('members.show.ban');


//Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
