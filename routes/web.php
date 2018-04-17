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
Route::get('/profile/{client}', 'DashboardController@showProfile')->name('showProfile');
Route::put('/profile/{client}', 'DashboardController@updateProfile')->name('profile.update');
Route::resource('/clients', 'ClientsController');
Route::get('/clients/{client}/dashboard', 'ClientsController@dashboard')->name('clients.dashboard');

Route::resource('/clients/{client}/retirement', 'RetirementController');
Route::get('/clients/{client}/retirement/{retirement}/payment', 'RetirementController@payment')->name('retirement.payment');
Route::post('/clients/{client}/retirement/{retirement}/payment', 'RetirementController@makePayment')->name('retirement.makePayment');
Route::get('/clients/{client}/retirement/{retirement}/pdf', 'RetirementController@pdf')->name('retirement.pdf');

Route::resource('/clients/{client}/education', 'EducationController');
Route::get('/clients/{client}/education/{education}/payment', 'EducationController@payment')->name('education.payment');
Route::post('/clients/{client}/education/{education}/payment', 'EducationController@makePayment')->name('education.makePayment');
Route::get('/clients/{client}/education/{education}/pdf', 'EducationController@pdf')->name('education.pdf');

Route::resource('/clients/{client}/accumulation', 'AccumulationController');
Route::get('/clients/{client}/accumulation/{accumulation}/payment', 'AccumulationController@payment')->name('accumulation.payment');
Route::post('/clients/{client}/accumulation/{accumulation}/payment', 'AccumulationController@makePayment')->name('accumulation.makePayment');
Route::get('/clients/{client}/accumulation/{accumulation}/pdf', 'AccumulationController@pdf')->name('accumulation.pdf');

Route::resource('/clients/{client}/emergency_fund', 'EmergencyFundController');
Route::get('/clients/{client}/emergency_fund/{emergency_fund}/payment', 'EmergencyFundController@payment')->name('emergency_fund.payment');
Route::post('/clients/{client}/emergency_fund/{emergency_fund}/payment', 'EmergencyFundController@makePayment')->name('emergency_fund.makePayment');
Route::get('/clients/{client}/emergency_fund/{emergency_fund}/pdf', 'EmergencyFundController@pdf')->name('emergency_fund.pdf');

Route::get('/logs', 'ActivityLogController@index')->name('logs.index');
Route::resource('/users', 'UsersController');
