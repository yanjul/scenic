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


Route::get('/get-scenic', 'HomeController@getScenic');

Route::get('/get-code', 'User\MsgController@sendCode');

Route::group(['prefix' => 'user', 'middleware' => 'auth', 'namespace' => 'user'], function () {

    Route::get('/', 'UserController@Index');

    Route::get('/info', 'UserController@getUserInfo');
    Route::match(['get', 'post'], '/info-update', 'UserController@updateInfo');
    Route::match(['get', 'post'], '/reset-password', 'UserController@resetPassword');
    Route::match(['get', 'post'], '/bind-mobile', 'UserController@bindMobile');

    Route::get('/scenic', 'ScenicController@getUserScenic');
    Route::get('/add-scenic/{id?}', 'ScenicController@add')->where('id', '^[0-9]+$');
    Route::post('/add-scenic', 'ScenicController@createScenic');
    Route::post('/update-scenic', 'ScenicController@updateScenic');
    Route::get('/del-scenic/{id}', 'ScenicController@deleteScenic')->where('id', '^[0-9]+$');

    Route::get('/scenic/{id}', 'TicketController@index')->where('id', '^[0-9]+$');
    Route::get('/add-ticket/{id}', 'TicketController@add')->where('id', '^[0-9]+$');
    Route::get('/scenic/ticket/{id}', 'TicketController@update')->where('id', '^[0-9]+$');
    Route::post('/scenic/ticket/{id}', 'TicketController@updateTicket')->where('id', '^[0-9]+$');
    Route::post('/add-ticket', 'TicketController@createTicket');
    Route::get('/del-ticket/{id}', 'TicketController@deleteTicket')->where('id', '^[0-9]+$');
});


//测试
Route::get('/search', function () {
    return view('search');
});
