<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// user profile
$route['addUser']['post']          = 'user/register';
$route['loginUser']['post']          = 'user/login';
$route['socialLogin']['post']          = 'user/SocialLogin';

$route['updateProfile']['post']          = 'user/updateprofile';
$route['getUser']['post']    = 'user/getuser';
$route['userChangepassword']['post']    = 'user/newpassword';
$route['userResetpassword']['post']    = 'user/user_changepassword';
$route['userSentcode']['post']    = 'user/user_check_sentcode';
$route['userLogout']['post']    = 'user/user_logout';

$route['myAddress']['post']    = 'user/savedAddress';
$route['getmyAddress']['post']    = 'user/get_savedAddress';
$route['deletemyAddress']['post']    = 'user/delete_myaddress';
$route['updatemyAddress']['post']    = 'user/update_savedAddress';
$route['getdriverTrips']['post']    = 'user/get_driverTrips';
$route['singleTrip']['post']    = 'user/get_singleTrip';
$route['allFromlist']['post']    = 'user/get_allFromlist';
$route['allTolist']['post']    = 'user/get_allTolist';
$route['addReview']['post']    = 'user/user_addReview';
$route['getReview']['post']    = 'user/user_getReview';
$route['confirmTrip']['post']    = 'user/user_confirmTrip';
$route['cancelTrip']['post']    = 'user/user_cancelTrip';

$route['userTrips']['post']    = 'user/user_Tripshistory';
$route['addPreferences']['post']    = 'user/user_Preferences';
$route['getPreferences']['post']    = 'user/get_user_preferences';

// passanger
$route['getPassanger']['post']    = 'user/get_user_passanger';
$route['cancelPassanger']['post']    = 'user/passanger_canceltrip';
// trips
$route['joinTrip']['post']    = 'user/user_joinTrip';
$route['tripFavoritelist']['post']    = 'user/get_user_favoritelist';

$route['sendmail']['post']    = 'user/send';
// driver profile
$route['addDriver']['post']          = 'driver/register_driver';
$route['driverLogin']['post']          = 'driver/login_driver';
$route['updateDriverprofile']['post']          = 'driver/updatedriver';
$route['driverApprovel']['post']          = 'driver/getdriver_approvel';
$route['driverProfile']['post']          = 'driver/getdriver_profile';
$route['driverRemove']['post']          = 'driver/remove_driverAccount';

$route['getDriverdata']['get']    = 'driver/getdriver/{id}';
$route['driverPhoto']['post']    = 'driver/updatedriver_photo';
$route['drivervehiclePhoto']['post']    = 'driver/updatedriver_vehiclephoto';
$route['driverChangepassword']['post']    = 'driver/update_driver_password';
$route['driverResetpassword']['post']    = 'driver/driver_changepassword';
$route['driverSentcode']['post']    = 'driver/check_sentcode';


$route['addVehicledetail']['post']    = 'driver/addVehicle';
$route['updateVehicledetail']['post']    = 'driver/update_vehicledata';
$route['getVehicledata']['post']    = 'driver/get_Vehicledata';
$route['tripUserlist']['post']    = 'driver/get_Tripuserlist';
$route['addBankdetails']['post']    = 'driver/addDriver_bankdetails';
$route['getBankdetails']['post']    = 'driver/getdriver_bankdata';
$route['updateBankdetails']['post']    = 'driver/updateBankdetails';
$route['getCountry']['post']    = 'driver/get_Country';
$route['getState']['post']    = 'driver/get_State';
$route['Triplocations']['post']    = 'driver/get_Triplocations';

$route['setDrivertrip']['post']    = 'driver/drivertripAddress';
$route['updateDrivertrip']['post']    = 'driver/update_drivertripAddress';
$route['removeDrivertrip']['post']    = 'driver/delete_drivertripAddress';
$route['myDrivertrip']['post']    = 'driver/current_driverTrips';
$route['singleDrivertrip']['post']    = 'driver/getdriver_singletrip';
$route['deleteVehicleplate']['post']    = 'driver/delete_vehiclePlate';
$route['tripDetails']['post']    = 'driver/driver_tripdetails';
$route['rattingDetails']['post']    = 'driver/driver_rattingscreen';
$route['drvierDocument']['post']    = 'driver/addDocuments';
$route['deleteDocuments']['post']    = 'driver/delete_Driverdocuments';
$route['getDriverdocuments']['post']    = 'driver/get_driverDocuments';
$route['lastLocation']['post']    = 'driver/update_driverLocation';
$route['onboardUserlist']['post']    = 'driver/onboardUserlist';
$route['allApprovelStatus']['post']    = 'driver/getdriver_allapprovel';
$route['getOnboardlist']['post']    = 'driver/get_allonboard_userlist';

// default
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;