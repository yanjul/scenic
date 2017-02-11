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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@Index');
    Route::get('/user', 'Web\UserController@Index');

    Route::get('/user/scenic', 'Web\ScenicController@getUserScenic');
    Route::get('/user/add-scenic/{id?}', 'Web\ScenicController@add')->where('id', '^[0-9]+$');
    Route::post('/user/add-scenic', 'Web\ScenicController@createScenic');
    Route::post('/user/update-scenic', 'Web\ScenicController@updateScenic');
    Route::get('/user/del-scenic/{id}', 'Web\ScenicController@deleteScenic')->where('id', '^[0-9]+$');

    Route::get('/user/add-ticket/{id}', 'Web\TicketController@add')->where('id', '^[0-9]+$');
    Route::post('/user/add-ticket', 'Web\TicketController@createTicket');
});


//测试
Route::get('/test',function(){return view('user.person');});
