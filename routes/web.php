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
//Auth::routes();
Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
});

Route::get('/', 'HomeController@Index');
Route::get('/home', 'HomeController@Index');
Route::get('/search', 'SearchController@index');


Route::get('/scenic/{id}', 'HomeController@ScenicDetail')->where('id', '^[0-9]+$');

//ajax
Route::get('/show-scenic', 'HomeController@getScenic');
Route::get('/get-code', 'User\MsgController@sendCode');
Route::get('/get-scenic', 'User\ScenicController@getScenic');
Route::get('/get-ticket', 'User\TicketController@getTicket');
//用户组
Route::group(['prefix' => 'user', 'middleware' => 'auth', 'namespace' => 'User'], function () {

    Route::get('/', 'UserController@Index');

    Route::get('/info', 'UserController@getUserInfo');
    Route::match(['get', 'post'], '/info-update', 'UserController@updateInfo');
    Route::match(['get', 'post'], '/reset-password', 'UserController@resetPassword');
    Route::match(['get', 'post'], '/bind-mobile', 'UserController@bindMobile');

    Route::get('/scenic', 'ScenicController@getUserScenic');
    Route::get('/add-scenic/{id?}', 'ScenicController@add')->where('id', '^[0-9]+$');
    Route::post('/add-scenic', 'ScenicController@createScenic');
    Route::post('/update-scenic', 'ScenicController@updateScenic');
    Route::get('/scenic/status', 'ScenicController@changeStatus');
    Route::get('/del-scenic/{id}', 'ScenicController@deleteScenic')->where('id', '^[0-9]+$');
    Route::get('/scenic/distribution', 'ScenicController@distribution')->middleware('pur:business');
    Route::any('/scenic/add-distribution/{id?}', 'ScenicController@distributionAdd')->where('id', '^[0-9]+$')->middleware('pur:business');
    Route::any('/scenic/create-distribution', 'ScenicController@createDistribution')->middleware('pur:business');
    Route::any('/scenic/del-distribution/{id?}', 'ScenicController@deleteDistribution')->where('id', '^[0-9]+$')->middleware('pur:business');

    Route::get('/scenic/{id}', 'TicketController@index')->where('id', '^[0-9]+$');
    Route::get('/add-ticket/{id}', 'TicketController@add')->where('id', '^[0-9]+$');
    Route::get('/scenic/ticket/{id}', 'TicketController@update')->where('id', '^[0-9]+$');
    Route::post('/scenic/ticket/{id}', 'TicketController@updateTicket')->where('id', '^[0-9]+$');
    Route::post('/add-ticket', 'TicketController@createTicket');
    Route::get('/ticket/status', 'TicketController@changeStatus');
    Route::get('/del-ticket/{id}', 'TicketController@deleteTicket')->where('id', '^[0-9]+$');

    Route::get('/order', 'OrderController@getOrder');
    Route::get('/payment', 'OrderController@getPayment');

});

Route::group(['prefix' => 'order', 'middleware' => 'auth'], function () {
    Route::post('/create', 'OrderController@create')->middleware('pur:mobile');
    Route::match(['get', 'post'], '/pay/{id}', 'OrderController@pay')->where('id', '^[0-9]+$');
    Route::get('/detail/{sn}', 'OrderController@detail')->where('sn', '^[0-9]+$');;
    Route::get('/cancel', 'OrderController@cancel');
    Route::get('/refunds', 'OrderController@refunds');
});
