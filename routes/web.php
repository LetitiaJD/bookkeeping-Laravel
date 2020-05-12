<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

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

Route::resource('account', 'AccountController');

Route::resource('category', 'CategoryController');

Route::resource('entry', 'EntryController');

Route::get('filter', 'EntryController@filter');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
