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

Route::resource('/', 'AlumniController');

Route::get('/retrieve', function(){
    return view('alumni-retrieve');
});

Route::post('/retrieve', 'AlumniController@retrieve');
Route::get('/alumni', function () {

    return view('alumni-success');
    // ...
});

Route::get('/export', 'HomeController@export');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
