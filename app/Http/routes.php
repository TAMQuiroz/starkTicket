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

Route::get('login_worker', 'Auth\AuthController@worker');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::get('home', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('modules', 'PagesController@modules');
Route::get('calendar', 'PagesController@calendar');
Route::get('gifts', 'PagesController@gifts');
Route::get('category', 'CategoryController@index');
Route::get('category/{id}', 'CategoryController@show');
Route::get('event', 'EventController@index');
Route::get('event/successBuy', 'EventController@successBuy');
Route::get('event/{id}', 'EventController@show');

Route::get('client/home', 'EventController@clientHome');
Route::get('client/event_record', 'EventController@clientRecord');
//Estos 2 inician en el detalle del evento
Route::get('client/event/{id}/buy', 'EventController@clientBuy');
Route::get('client/{id}/reservanueva', ['as' => 'booking.create' , 'uses' => 'BookingController@create']);
//Fin
Route::get('client/reservaexitosa', 'BookingController@store');


Route::get('salesman/home', 'BusinessController@salesmanHome');
Route::get('salesman/cash_count', 'BusinessController@cashCount');
Route::get('salesman/exchange_gift', 'BusinessController@exchangeGift');
//Este inicia en el detalle del evento
Route::get('salesman/event/{id}/buy', 'EventController@salesmanBuy');
//Fin

Route::get('promoter/home', 'BusinessController@promoterHome');
Route::get('promoter/politics', 'EventController@politics');
Route::get('promoter/transfer_payments', 'BusinessController@transferPayments');
Route::get('promoter/new_transfer_payment', 'BusinessController@newTransferPayment');
Route::get('promoter/event/record', 'EventController@promoterRecord');
Route::get('promoter/event/create', 'EventController@newEvent');
Route::get('promoter/promotion', 'BusinessController@promotion');
Route::get('promoter/organizers', 'BusinessController@organizers');
Route::get('promoter/organizer/create', 'BusinessController@newOrganizer');


Route::get('admin/home', 'AdminController@home');
Route::get('admin/politics', 'AdminController@politics');
Route::get('admin/politics/new', 'AdminController@newPolitic');
Route::get('admin/politics/{id}/edit', 'AdminController@editPolitic');
Route::get('admin/exchange_gift', 'AdminController@exchangeGift');
Route::get('admin/gifts', 'AdminController@gifts');
Route::get('admin/gifts/new', 'AdminController@newGift');
Route::get('admin/gifts/{id}/edit', 'AdminController@editGift');
Route::get('admin/category', 'AdminController@categoryList');
Route::get('admin/category/new', 'AdminController@newCategory');
Route::get('admin/category/{id}/edit', 'AdminController@editCategory');
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
Route::get('admin/modules/{id}/edit', 'AdminController@editModule');
Route::get('admin/salesman', 'AdminController@salesman');
Route::get('admin/promoter', 'AdminController@promoter');
Route::get('admin/admin', 'AdminController@admin');
Route::get('admin/user/new', 'AdminController@newUser');