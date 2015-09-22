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

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::get('login_client', 'Auth\AuthController@client');
Route::get('login_worker', 'Auth\AuthController@worker');

Route::get('signin', 'Auth\AuthController@signin');


Route::get('home', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('modules', 'PagesController@modules');
Route::get('calendar', 'PagesController@calendar');
Route::get('exchange', 'PagesController@exchange');
Route::get('category', 'CategoryController@index');
Route::get('category/{id}', 'CategoryController@show');


Route::get('event', 'EventController@index');
Route::get('event/create', 'EventController@create');
Route::get('event/promoter_record', 'EventController@promoterRecord');
Route::get('event/client_record', 'EventController@clientRecord');
Route::get('event/{id}', 'EventController@show');
Route::get('event/{id}/buy', 'EventController@buy');
Route::get('event/{id}/reserve', 'EventController@reserve');

Route::get('salesman/cash_count', 'BusinessController@cashCount');
Route::get('salesman/transfer_payments', 'BusinessController@transferPayments');

Route::get('reservanueva', ['as' => 'booking.create' , 'uses' => 'BookingController@create']);
Route::get('reservaexitosa', 'BookingController@store');

Route::get('promoter/promotion', 'BusinessController@promotion');



Route::get('admin/category', 'AdminController@categoryList');
Route::get('admin/category/new', 'AdminController@new');
Route::get('admin/ticket_return', 'AdminController@ticketReturn');
Route::get('admin/ticket_return/new', 'AdminController@newTicketReturn');
Route::get('admin/attendance', 'AdminController@attendance');
Route::get('admin/config/exchange_rate', 'AdminController@exchangeRate');
Route::get('admin/config/about', 'AdminController@about');
Route::get('admin/config/system', 'AdminController@system');
Route::get('admin/report', 'AdminController@reportList');
Route::get('admin/report/{id}', 'AdminController@report');
Route::get('admin/modules', 'AdminController@modules');
Route::get('admin/modules/new', 'AdminController@newModule');
