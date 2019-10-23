<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Driver API
Route::apiResource('drivers', 'ApiControllers\DriverController');
Route::post('driver/create', 'ApiControllers\DriverController@store');
Route::post('driver/login', 'ApiControllers\DriverController@loginDriver');
Route::get('drivers/get_driver', 'ApiControllers\DriverController@show');
Route::post('driver/update', 'ApiControllers\DriverController@update');
Route::any('driver/approval', 'ApiControllers\DriverController@getDriverapproval');
Route::any('driver/profile', 'ApiControllers\DriverController@getDriverprofile');
Route::any('driver/update_photo', 'ApiControllers\DriverController@updateDriverPhoto');
Route::any('driver/update_vehicle_profile', 'ApiControllers\DriverController@updateVehicleProfile');
Route::any('driver/change_password', 'ApiControllers\DriverController@updateDriverPassword');
Route::any('driver/check_sent_code', 'ApiControllers\DriverController@checkSentCode');
Route::post('driver/add_vehicle', 'ApiControllers\DriverController@addVehicle');
Route::any('driver/get_vehicle', 'ApiControllers\DriverController@getVehicle');
Route::post('driver/update_vehicle', 'ApiControllers\DriverController@updateVehicle');
Route::post('driver/delete_vehicle', 'ApiControllers\DriverController@deleteVehicle');
Route::post('driver/add_bank_details', 'ApiControllers\DriverController@addBankDetails');
Route::any('driver/get_bank_details', 'ApiControllers\DriverController@getBankDetails');
Route::post('driver/update_bank_details', 'ApiControllers\DriverController@updateBankDetails');
Route::get('get_countries', 'ApiControllers\DriverController@getCountries');
Route::get('get_cities', 'ApiControllers\DriverController@getCities');
Route::post('driver/add_trip', 'ApiControllers\DriverController@addTrip');
Route::get('driver/get_trip', 'ApiControllers\DriverController@getTrip');
Route::post('driver/delete_trip', 'ApiControllers\DriverController@deleteTrip');
Route::post('driver/update_driver_location', 'ApiControllers\DriverController@updateDriverLocation');

Route::post('addUser', 'UserModelController@register');
Route::post('loginUser', 'UserModelController@login');
Route::get('getUser/{id}', 'UserModelController@getuser');
Route::post('updateProfile/{id}', 'UserModelController@updateprofile');
Route::post('userSentcode', 'UserModelController@user_check_sentcode');
Route::post('userChangepassword/{id}', 'UserModelController@user_changepassword');

// user address
Route::post('myAddress', 'UserModelController@savedAddress');
Route::get('getmyAddress/{id}', 'UserModelController@getmyaddress');
Route::patch('updatemyAddress/{id}', 'UserModelController@update_savedAddress');
Route::delete('deletemyAddress/{id}', 'UserModelController@delete_myaddress');