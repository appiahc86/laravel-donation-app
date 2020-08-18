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
Auth::routes();

Route::get('/', function (){
    return view('auth.login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/donations', 'DonationController@store')->name('donation.store');
Route::get('/donations/{id}', 'DonationController@edit')->name('donation-edit');
Route::patch('/donations/update/{id}', 'DonationController@update')->name('donation.update');
Route::delete('/donations/delete/{id}', 'DonationController@destroy')->name('donation-destroy');


Route::get('/print', 'DonationController@printOut')->name('print');






