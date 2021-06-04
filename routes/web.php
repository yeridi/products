<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', 'ProductController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/reset/mypassword', 'EmailController@sendEmail')->name('reset.email');
Route::get('/reset/showform', 'EmailController@verifyToken')->name('email.token');
Route::put('/reset/update/password/{id}','EmailController@updatePassword')->name('update.password');