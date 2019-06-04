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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/adminArea', 'HomeController@goToAdminArea')->middleware('role:admin');
Route::get('/doctorArea', 'HomeController@goToDoctorArea')->middleware('role:doctor');
Route::get('/patientArea', 'HomeController@goToPatientArea')->middleware('role:patient');
Route::get('/showUserDetails/{id}', 'HomeController@showUserDetails');

Route::get('/appointAs/{id}', 'AdminController@appointAs');

Route::get('/closeAppointment/{id}', 'DoctorController@closeAppointment');

Route::get('/createAppointment', 'PatientController@createAppointment');
Route::post('/createAppointment/create', 'PatientController@create');

Route::get('/showAppointment/{id}', 'AppointmentController@showAppointment');
Route::post('/editAppointment/{id}', 'AppointmentController@editAppointment');
Route::post('/editReciept/{id}', 'AppointmentController@editReciept');
Route::get('/deleteReciept/{id}', 'AppointmentController@deleteReciept');
Route::get('/deleteAppointment/{id}', 'AppointmentController@deleteAppointment');
Route::get('/acceptAppointment/{id}', 'AppointmentController@acceptAppointment');
