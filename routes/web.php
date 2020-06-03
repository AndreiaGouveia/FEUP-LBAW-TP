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
use App\Mail\welcomeMail ;

// IF USER IS LOGGED IN AND IS ACCOUNT IS NOT ACTIVE/VISIBLE WE REDIRECT TO ACTIVE
Route::group(['middleware' => ['unactiveUser']], function () {

    //Default page
    Route::get('/', 'HomeController@home');

    //Static Pages
    Route::get('home', 'HomeController@show')->name('home');
    Route::get('about', 'AdministratorController@about')->name('about');

    //EMAIL
    Route::get('/email', function(){
        return new welcomeMail();
    });


    //Members
    Route::get('members/{id}', 'MemberController@show')->name('members');

    //ONLY MEMBERS CAN ACCESS THIS
    Route::group(['middleware' => ['member']], function () {
        Route::get('members/{id}/content', 'MemberController@content')->name('member.content');
        Route::get('members/{id}/favorites', 'MemberController@favorites')->name('member.favorites');
        Route::get('members/{id}/settings', 'MemberController@edit')->name('settings');
        Route::post('members/{id}', 'MemberController@update')->name('members.update');
        Route::post('members/{id}/password', 'MemberController@updatePassword')->name('members.update.password');
        Route::post('members/{id}/deactivate', 'MemberController@deactivate')->name('members.deactivate');

        //Questions
        Route::get('questions', 'QuestionController@create')->name('add.questions');
        Route::post('questions', 'QuestionController@store')->name("store.question");

        Route::get('questions/{id}/edit', 'QuestionController@edit')->name("edit.question");
        Route::post('questions/{id}/edit', 'QuestionController@update')->name("update.question");

        //Responses
        Route::get('response/{id}/edit', 'ResponseController@edit')->name("edit.response");
        Route::post('response/{id}/edit', 'ResponseController@update')->name("update.response");

        //Comments
        Route::get('comment/{id}/edit', 'CommentController@edit')->name("edit.comment");
        Route::post('comment/{id}/edit', 'CommentController@update')->name("update.comment");

        // API
        Route::post('api/questions/{id}/answers', 'ResponseController@store');

        Route::post('api/publications/{id}/comments', 'CommentController@store');

        Route::post('api/publications/{id}/likes', 'LikesController@store');
        Route::post('api/publications/{id}/likes/delete', 'LikesController@destroy');

        Route::post('api/publications/{id}/favorites', 'FavoriteController@store');
        Route::post('api/publications/{id}/favorites/delete', 'FavoriteController@destroy');

        Route::post('api/publications/{id}/report', 'PublicationController@report');
    });

    //Only Admin can do these things
    Route::group(['middleware' => ['admin']], function () {
        Route::post('/members/{id}/promote', 'MemberController@promote')->name('member.promote');
        Route::post('/members/{id}/demote', 'MemberController@demote')->name('member.demote');
        Route::post('/members/{id}/ban', 'MemberController@ban')->name('member.ban');
        Route::post('/members/{id}/unban', 'MemberController@unban')->name('member.unban');
        Route::get('/admin/panel', 'AdministratorController@panel')->name('admin.panel');
        Route::get('about/edit', 'AdministratorController@edit_about_us')->name('about.edit');
        Route::post('about/edit', 'AdministratorController@update_about_us')->name('about.edit.post');
    });

    //Search
    Route::get('search/{query}', 'HomeController@search')->name("search");
    Route::post('search', 'HomeController@postSearch')->name("search.post");
    Route::get('search/tags/{tag}', 'HomeController@searchTopic')->name("search.topic");

    //Questions
    Route::get('questions/{id}#{id2}', 'QuestionController@show')->name("show.question.element");
    Route::get('questions/{id}', 'QuestionController@show')->name("show.question");
   
    //API
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
Route::get('/forgotPassword', 'Auth\ForgotPasswordController@forgot');
Route::post('/forgotPassword', 'Auth\ForgotPasswordController@password');


Route::get('/redirect', 'Auth\RegisterController@redirectToProvider')->name('registerGoogle');;
Route::get('/callback', 'Auth\RegisterController@handleProviderCallback');
