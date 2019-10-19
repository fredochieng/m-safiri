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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Routes for companies
Route::resource('companies', 'CompaniesController');
Route::any('/company/manage/&id={id}', 'CompaniesController@manageCompany');

//Routes for vehicles
Route::resource('/vehicles/all', 'VehiclesController');
Route::any('/vehicle/manage/&id={id}', 'VehiclesController@manageVehicle');
Route::any('/driver/assign', 'VehiclesController@assignDriver');

//Routes for drivers
Route::resource('/drivers', 'DriverController');
Route::any('/driver/manage/&id={id}', 'DriverController@manageDriver');
Route::resource('/routes', 'RoutesController');

Route::any('/routes/create', 'RoutesController@create');


//Routes for trips
Route::resource('/tripPrices', 'TripPriceController');

//Routes for locations
Route::resource('/locations', 'LocationsController');

//Routes for mechanics
Route::resource('/mechanics', 'MechanicController');

//Routes for trips
Route::resource('/trips', 'TripController');

//Routes for review
Route::any('/reviews', 'ReviewController@index');

// Routes for reports
Route::any('/reports/cancelled_reports', 'ReportsController@cancelledTrips');

// Routes for api
Route::any('/apis', 'APIController@index');