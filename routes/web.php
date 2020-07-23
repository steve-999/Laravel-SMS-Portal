<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'SendMessageController@index');
Route::post('/send', 'SendMessageController@validateMessage');

Route::get('/messages', 'MessagesController@index'); 
Route::get('/messages/create', 'MessagesController@create'); 
Route::get('/messages/{msg_id}', 'MessagesController@show'); 

Route::get('/signup', 'UserController@signup');
Route::post('/signup', 'UserController@store');
Route::get('/login', 'UserController@login');
Route::get('/dashboard', 'UserController@dashboard');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
