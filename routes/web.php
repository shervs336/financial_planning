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

Auth::routes();

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::resource('/clients', 'ClientsController');
Route::get('/clients/{client}/dashboard', 'ClientsController@dashboard')->name('clients.dashboard');

Route::resource('/clients/{client}/retirement', 'RetirementController');
Route::resource('/clients/{client}/education', 'EducationController');
Route::resource('/clients/{client}/accumulation', 'AccumulationController');
