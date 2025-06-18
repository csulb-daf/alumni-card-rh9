<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\HomeController;
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

Route::resource('/', AlumniController::class);

Route::get('/retrieve', function () {
    return view('alumni-retrieve');
});

Route::post('/retrieve', [AlumniController::class, 'retrieve']);
Route::get('/alumni', function () {

    return view('alumni-success');
    // ...
});

Auth::routes(['register' => false]);
Route::get('/export', [HomeController::class, 'export']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
