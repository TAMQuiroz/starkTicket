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
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('login_worker', 'Auth\AuthController@worker');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'ClientController@store');


Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('modules', 'ModuleController@indexExternal');
Route::get('calendar', 'PagesController@calendar');
Route::get('gifts', 'GiftController@indexExternal');
Route::get('category', 'CategoryController@indexExternal');
Route::get('category/{id}', 'CategoryController@showExternal');
Route::get('category/{id}/subcategory', 'CategoryController@indexSub');
Route::get('category/{id}/subcategory/{id2}', 'CategoryController@showSub');
Route::get('event', 'EventController@indexExternal');

Route::get('event/{id}', 'EventController@showExternal');

Route::group(['middleware' => ['auth', 'client']], function () {
    Route::get('client/', 'ClientController@profile');
    Route::get('client/edit', 'ClientController@edit');
    Route::post('client/update', 'ClientController@update');
    Route::get('client/password', 'ClientController@password');
    Route::post('client/password', 'ClientController@passwordUpdate');
    Route::get('client/photo', 'ClientController@photoEdit');
    Route::post('client/photo', 'ClientController@photoUpdate');
    Route::get('client/home', 'PagesController@clientHome');
    Route::get('client/event_record', 'EventController@showClientRecord');
    //Estos 2 inician en el detalle del evento
    Route::get('client/event/{id}/buy', 'TicketController@createClient');
    Route::post('client/event/store', ['uses'=>'TicketController@store','as'=>'ticket.store.client']);
    Route::get('client/event/successBuy', ['uses'=>'TicketController@showSuccess','as'=>'ticket.success.client']);
    Route::get('client/{id}/reservanueva', ['as' => 'booking.create' , 'uses' => 'BookingController@create']);
    //Fin
    Route::get('client/reservaexitosa', 'BookingController@store');
});

Route::group(['middleware' => ['auth', 'salesman']], function () {
    Route::get('salesman', 'PagesController@salesmanHome');
    Route::get('salesman/cash_count', 'BusinessController@cashCount');
    Route::get('salesman/exchange_gift', 'GiftController@createExchange');
    Route::get('salesman/event/{id}/pay_booking', 'BookingController@pay');
    Route::get('salesman/giveaway', 'TicketController@giveaway');
    //Este inicia en el detalle del evento
    Route::get('salesman/event/{id}/buy', 'TicketController@createSalesman');
    Route::post('salesman/event/store', ['uses'=>'TicketController@store','as'=>'ticket.store']);
    Route::get('salesman/event/successBuy', ['uses'=>'TicketController@showSuccessSalesman','as'=>'ticket.success.salesman']);
    
});

//Rutas generales para peticiones ajax, pueden ser usadas por varios usuarios, por eso lo saque
Route::get('getClient', ['uses'=>'TicketController@getClient','as'=>'ajax.getClient']);
Route::get('getPrice', ['uses'=>'TicketController@getPrice','as'=>'ajax.getPrice']);
Route::get('getAvailable', ['uses'=>'TicketController@getAvailable','as'=>'ajax.getAvailable']);
Route::get('getSlots', ['uses'=>'TicketController@getSlots','as'=>'ajax.getSlots']);
Route::get('getZone', ['uses'=>'TicketController@getZone','as'=>'ajax.getZone']);
Route::get('getTakenSlots', ['uses'=>'TicketController@getTakenSlots','as'=>'ajax.getTakenSlots']);
Route::get('getPromo', ['uses'=>'TicketController@getPromo','as'=>'ajax.getPromo']);


Route::group(['middleware' => ['auth', 'promoter']], function () {
    Route::post('promoter/event/create', ['as' => 'events.store', 'uses' =>'EventController@store']);
    Route::post('promoter/event/{event_id}/edit', ['as' => 'events.update', 'uses' =>'EventController@update']);
    Route::get('promoter/', ['as'=>'promoter.home','uses'=>'PagesController@promoterHome']);
    Route::get('promoter/politics', 'PoliticController@index');
    Route::get('promoter/politics', 'PoliticController@politicsPromotor');

    Route::get('promoter/event/recordPayment', 'PaymentController@index');
    Route::get('promoter/transfer_payments', 'PaymentController@create');
    Route::get('promoter/event/record', ['as'=>'promoter.record','uses'=>'EventController@showPromoterRecord']);
    Route::get('promoter/event/create', 'EventController@create');
    Route::get('promoter/event/{event_id}/edit', ['as' => 'events.edit', 'uses' =>'EventController@edit']);

    Route::get('promoter/event/{event_id}', ['as' => 'events.show', 'uses' =>'EventController@show']);
    Route::get('promoter/{category_id}/subcategories', 'EventController@subcategoriesToAjax');
    Route::get('getLocal/{id}',['as'=>'ajax.getLocal','uses'=>'EventController@getLocal']);


    Route::get('promoter/promotion', 'PromoController@index');
     Route::get('promoter/promotion', 'PromoController@promotion');



    Route::get('promoter/promotion/new', ['as'=>'promo.create','uses'=>'PromoController@create']);
     Route::post('promoter/promotion/new', ['as'=>'promo.store','uses'=>'PromoController@store']);
    Route::get('promoter/promotion/new/{event_id}', 'PromoController@ajax');
    Route::get('promoter/promotion/{id}/edit', ['as'=>'promo.edit','uses'=>'PromoController@edit']);
    Route::post('promoter/promotion/{id}/edit',  'PromoController@update');
    Route::get('promoter/promotion/{id}/delete',  'PromoController@destroy');
    




    //Aca se inicia el CRUD de promotor
    Route::get('promoter/organizers', 'OrganizerController@index');
    Route::get('promoter/organizer/create', 'OrganizerController@create');




    Route::post('promoter/organizer/create', 'OrganizerController@store');
    Route::get('promoter/organizer/{id}/edit', 'OrganizerController@edit');
    Route::post('promoter/organizer/{id}/edit', 'OrganizerController@update'); // faltan
    Route::get('promoter/organizer/{id}/delete', 'OrganizerController@destroy');
});

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('admin/', ['uses'=>'PagesController@adminHome','as'=>'admin.home']);
    Route::get('admin/politics', 'PoliticController@politics');
    Route::get('admin/politics/new', 'PoliticController@create');
    Route::post('admin/politics/new', 'PoliticController@store');
    Route::get('admin/politics/{id}/edit', 'PoliticController@edit');
    Route::post('admin/politics/{id}/edit', 'PoliticController@update');

    Route::get('admin/local', 'LocalController@index');
    Route::get('admin/local/new', 'LocalController@create');
    Route::post('admin/local/new', 'LocalController@store');
    Route::get('admin/local/{id}/edit', 'LocalController@edit');
    Route::post('admin/local/{id}/edit', 'LocalController@update');
    Route::get('admin/local/{id}/delete', 'LocalController@destroy');

    Route::get('admin/exchange_gift', 'GiftController@createExchangeAdmin');

    Route::get('admin/gifts', 'GiftController@index');
    Route::get('admin/gifts/new', 'GiftController@create');
    Route::post('admin/gifts/new', 'GiftController@store');
    Route::get('admin/gifts/{id}/edit', 'GiftController@edit');
    Route::post('admin/gifts/{id}/edit', 'GiftController@update');
    Route::get('admin/gifts/{id}/delete', 'GiftController@destroy');

    Route::get('admin/category', ['as' => 'admin.categories.index', 'uses' =>'CategoryController@index']);
    Route::get('admin/category/new', 'CategoryController@create');
    Route::post('admin/category/new', ['as' => 'categories.store', 'uses' =>'CategoryController@store']);
    Route::get('admin/category/{id}/edit', ['as' => 'categories.edit', 'uses' =>'CategoryController@edit']);
    Route::post('admin/category/{id}/edit', ['as' => 'categories.update', 'uses' =>'CategoryController@update']);
    Route::post('admin/category/{id}/delete', ['as' => 'categories.delete', 'uses' =>'CategoryController@destroy']);
    Route::get('admin/category/{id}/subcategories', ['as' => 'subcategories.index', 'uses' =>'CategoryController@indexSubAdmin']);

    Route::get('admin/ticket_return', 'TicketController@indexReturn');
    Route::get('admin/ticket_return/new', 'TicketController@createReturn');

    Route::get('admin/attendance', 'BusinessController@attendance');

    Route::get('admin/config/exchange_rate', 'BusinessController@exchangeRate');
    Route::post('admin/config/exchange_rate', 'BusinessController@storeExchangeRate');
    Route::get('admin/config/about', 'BusinessController@about');
    Route::get('admin/config/system', 'BusinessController@system');

    Route::get('admin/report/assistance', 'ReportController@showAssistance');
    Route::get('admin/report/sales', 'ReportController@showSales');
    Route::get('admin/report/assignment', 'ReportController@showAssigment');

    Route::get('admin/modules', 'ModuleController@index');
    Route::get('admin/modules/new', 'ModuleController@create');
    Route::post('admin/modules/new', 'ModuleController@store');
    Route::get('admin/modules/{id}/edit', 'ModuleController@edit');
    Route::post('admin/modules/{id}/edit', 'ModuleController@update');
    Route::get('admin/modules/{id}/delete', 'ModuleController@destroy');

    Route::get('admin/client', 'ClientController@index');
    Route::post('admin/client/desactive', 'ClientController@desactive');


    Route::get('admin/salesman', 'AdminController@salesman');
    Route::get('admin/salesman/{id}/edit', 'AdminController@editSalesman');
    Route::post('admin/salesman/{id}/edit', 'AdminController@updateSalesman');
    Route::get('admin/salesman/{id}/delete', 'AdminController@destroySalesman');


    Route::get('admin/user/new', 'AdminController@newUser');
    Route::post('admin/user/new', 'AdminController@store');

    Route::get('admin/admin', 'AdminController@admin');
    Route::get('admin/admin/{id}/edit', 'AdminController@editAdmin');
    //MANTENER PROMOTOR: No existia la ruta de post :C
    Route::post('admin/admin/{id}/edit', 'AdminController@updateAdmin');
    //
    Route::get('admin/admin/{id}/delete', 'AdminController@destroy');

    Route::get('admin/promoter', 'AdminController@promoter');
    Route::get('admin/promoter/{id}/edit', 'AdminController@editPromoter');
    Route::post('admin/promoter/{id}/edit', 'AdminController@updatePromoter');
    Route::get('admin/promoter/{id}/delete', 'AdminController@destroyPromoter');
})  ;

Route::get('token',function(){
    return csrf_token();
});


