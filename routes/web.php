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

App::setLocale("es");

Route::get('/', function () {
    return view('layouts.admin');
});

Auth::routes();

Route::resource('activities','ActivityController');

Route::get('/home', 'HomeController@index')->name('home');
