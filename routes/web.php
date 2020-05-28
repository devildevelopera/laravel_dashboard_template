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

Route::get('/', function () {
    return redirect('/stations');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/stations','StationsController');
Route::resource('/locations','LocationsController');
Route::resource('/gas','GasPricesController');
Route::resource('/advertisers', 'AdvertisersController');
Route::resource('/ads', 'AdsController');
