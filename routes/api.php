<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::group(['middleware' => 'auth:api'], function()
{
    Route::get('ticket-event', 'Api\TicketEventController@index');
    Route::get('ticket-event/{id}', 'Api\TicketEventController@show');
    Route::get('ticket-event/user/{name}', 'Api\TicketEventController@showByUser');
    Route::post('ticket-event', 'Api\TicketEventController@store');
    Route::put('ticket-event/{id}', 'Api\TicketEventController@update');
    Route::delete('ticket-event/{id}', 'Api\TicketEventController@destroy');
});

Route::group(['middleware' => 'auth:api'], function()
{
    Route::get('ticket-movie', 'Api\TicketMovieController@index');
    Route::get('ticket-movie/{id}', 'Api\TicketMovieController@show');
    Route::get('ticket-movie/user/{name}', 'Api\TicketMovieController@showByUser');
    Route::post('ticket-movie', 'Api\TicketMovieController@store');
    Route::put('ticket-movie/{id}', 'Api\TicketMovieController@update');
    Route::delete('ticket-movie/{id}', 'Api\TicketMovieController@destroy');
});

Route::group(['middleware' => 'auth:api'], function()
{
    Route::get('user', 'Api\UserController@index');
    Route::get('user/{id}', 'Api\UserController@show');
    Route::post('user', 'Api\UserController@store');
    Route::put('user/{id}', 'Api\UserController@update');
    Route::delete('user/{id}', 'Api\UserController@destroy');
});

Route::get('email/verify/{id}', 'VerificationApiController@verify')->name('verificationapi.verify');
Route::get('email/resend', 'VerificationApiController@resend')->name('verificationapi.resend');
