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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login_client', 'LoginController@client');
Route::get('login_worker', 'LoginController@worker');

Route::get('signin', 'SignInController@signin');

Route::get('home', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('modules', 'PagesController@modules');
Route::get('calendar', 'PagesController@calendar');
Route::get('exchange', 'PagesController@exchange');

Route::get('event', 'EventController@index');
Route::get('event/create', 'EventController@create');
Route::get('event/{id}', 'EventController@show');


Route::get('category', 'CategoryController@index');
Route::get('category/{id}', 'CategoryController@show');

Route::get('report', 'ReportController@index');
Route::get('report/{id}', 'ReportController@show');
