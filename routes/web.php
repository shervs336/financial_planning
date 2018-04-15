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

Route::get('refresh-csrf', function(){
    return csrf_token();
})->name('refresh-csrf');

Auth::routes();

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/export', 'DashboardController@export')->name('export');
Route::get('/import', 'DashboardController@showImport')->name('showImport');
Route::post('/import', 'DashboardController@import')->name('import');
Route::resource('/clients', 'ClientsController');
Route::get('/clients/{client}/dashboard', 'ClientsController@dashboard')->name('clients.dashboard');

Route::resource('/clients/{client}/retirement', 'RetirementController');
Route::resource('/clients/{client}/education', 'EducationController');
Route::resource('/clients/{client}/accumulation', 'AccumulationController');
Route::resource('/clients/{client}/emergency_fund', 'EmergencyFundController');
Route::get('/logs', 'ActivityLogController@index')->name('logs.index');

Route::resource('/users', 'UsersController');
