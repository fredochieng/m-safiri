<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome Turyde to API</title>

    <style type="text/css">
        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
    </style>
</head>

<body>

    <div id="container">
        <h1>M-safiri API - USER</h1>

        <div id="body">
            <p>User Register API : </p>
            <p>
                {{ $app_url }}addUser</p>
            <p>
                parameteres : user_email , password , device_id ,device_token
            </p>_____________
            <p>User Login API : </p>
            <p>
                {{ $app_url }}loginUser</p>
            <p>
                parameteres : user_email , password
            </p>_____________
            <p>Social Login API : </p>
            <p>
                {{ $app_url }}socialLogin</p>
            <p>
                parameteres : login_type [fblogin / glogin] , user_email , fname , lname , device_id , device_token ,
                token [gtoken / ftoken]
            </p>_____________
            <p>Getuser API : </p>
            <p>
                {{ $app_url }}getUser</p>
            <p>
                parameteres : user_id
            </p>_____________
            <p>Update user profile API : </p>
            <p>
                {{ $app_url }}updateProfile</p>
            <p>
                parameteres : user_id , photo , mobile_number ,gender ,fname ,lname ,country , user_email
            </p>_____________
            <p>User changepassword API : </p>
            <p>
                {{ $app_url }}userChangepassword</p>
            <p>
                parameteres : user_id , password , old_password
            </p>_____________
            <p>user reset password API : </p>
            <p>
                {{ $app_url }}userResetpassword</p>
            <p>
                parameteres : user_id , password
            </p>_____________
            <p>user email Sentcode API : </p>
            <p>
                {{ $app_url }}userSentcode</p>
            <p>
                parameteres : user_email , sentcode
            </p>_____________
            <p>User My saved address API : </p>
            <p>
                {{ $app_url }}myAddress</p>
            <p>
                parameteres : user_id , title , lat , lng , address
            </p>_____________
            <p>Get My saved address API : </p>
            <p>
                {{ $app_url }}getmyAddress</p>
            <p>
                parameteres : user_id
            </p>_____________
            <p>Remove My saved address API : </p>
            <p>
                {{ $app_url }}deletemyAddress</p>
            <p>
                parameteres : id
            </p>_____________
            <p>Update My saved address API : </p>
            <p>
                {{ $app_url }}updatemyAddress</p>
            <p>
                parameteres : id , user_id , title , lat , lng , address
            </p>_____________
            <p>Get all driver trip location API : </p>
            <p>
                {{ $app_url }}getdriverTrips</p>
            <p>
                parameteres : user_id, from_title, from_lat, from_lng, from_address, to_title, to_lat, to_lng,
                to_address , rating[yes], price [high/low]</p>_____________
            <p>Get singleTrip location API : </p>
            <p>
                {{ $app_url }}singleTrip</p>
            <p>
                parameteres : id, user_id
            </p>_____________
            <p>Get all trip - home screen API : </p>
            <p>
                {{ $app_url }}allFromlist</p>
            <p>
            </p>_____________
            <p>Get all trip from-to home screen API : </p>
            <p>
                {{ $app_url }}allTolist</p>
            <p>
                parameteres : from_titled
            </p>_____________
            <p>User join trip API : (Merge with confirm trip)</p>
            <p>
                {{ $app_url }}joinTrip</p>
            <p>
                parameteres : trip_id , user_id , driver_id , status('0','confirm','cancel','booked','onboard','missed')
            </p>_____________
            <p>User add review API : </p>
            <p>
                {{ $app_url }}addReview</p>
            <p>
                parameteres : trip_id , user_id , driver_id , rating , comments
            </p>_____________
            <p>User get review API : </p>
            <p>
                {{ $app_url }}getReview</p>
            <p>
                parameteres : trip_id , user_id
            </p>_____________
            <p>User trip history API : </p>
            <p>
                {{ $app_url }}userTrips</p>
            <p>
                parameteres : user_id
            </p>_____________
            <p>User trip confirm / book / cancel API : </p>
            <p>
                {{ $app_url }}confirmTrip</p>
            <p>
                parameteres : id,trip_id , user_id , trip_screenshot , cancel_reason ,status ['confirm', 'cancel',
                'booked'] , passanger_name
            </p>_____________
            <p>User trip Passanger list API : </p>
            <p>
                {{ $app_url }}getPassanger</p>
            <p>
                parameteres : book_id
            </p>_____________
            <p>Passanger cancel API : </p>
            <p>
                {{ $app_url }}cancelPassanger</p>
            <p>
                parameteres : passanger_id
            </p>_____________
            <p>User trip cancel API : </p>
            <p>
                {{ $app_url }}cancelTrip</p>
            <p>cancelTrip
                parameteres : trip_id , user_id
            </p>_____________
            <p>Tell your Driver(Preferences) Api : </p>
            <p>
                {{ $app_url }}addPreferences</p>
            <p>
                parameteres : driver_id , trip_id , user_id , music ,medical
            </p>_____________
            <p>get Preferences Api : </p>
            <p>
                {{ $app_url }}getPreferences</p>
            <p>
                parameteres : trip_id , user_id
            </p>_____________
            <p>get user favorite trip list Api : </p>
            <p>
                {{ $app_url }}tripFavoritelist</p>
            <p>
                parameteres : user_id
            </p>_____________
            <p>User first screen - OTP API [POST]: </p>
            <p>http://itechgaints.com/M-Safiri/africastalking/example/regUserget.php</p>
            <p>parameteres : mobile_number , device_id , device_token</p>
            _____________
            <p>Forgotpassword - OTP API [GET]: </p>
            <p>http://itechgaints.com/M-Safiri/africastalking/example/forgotpassword-otp.php?mobile_number=xxxx&type=xxx
            </p>
            <p>parameteres : mobile_number, type (driverdata , userdata)</p>
            _____________
            <p>Check OTP API- [GET]: </p>
            <p>http://itechgaints.com/M-Safiri/Msafiri-AdminPanel/check-otp-userdata.php?sentcode=1234&id=1&type=xxxx
            </p>
            <p>parameteres : sentcode , id , type (driverdata , userdata)</p>
            _____________
            <p>User logout API- [GET]: </p>
            <p>{{ $app_url }}userLogout</p>
            <p>parameteres : user_id , device_token
                _____________
        </div>

    </div>

    <div id="container">
        <h1>Turyde API - DRIVER</h1>

        <div id="body">
            <p>Driver Register API : </p>
            <p>
                {{ $app_url }}/api/driver/create</p>------Status:Done-------<p>
                parameteres : type ('individual', 'company'),fullname ,email , password , device_id , device_token
            </p>_____________
            <p>Driver Login API : </p>
            <p>
                {{ $app_url }}/api/driver/login</p>------Status:Done-------
            <p>
                parameteres : email , password
            </p>_____________
            <p>Getdriver API : </p>
            <p>
                {{ $app_url }}/api/drivers/get_driver</p>------Status:Done-------
            <p>
                parameteres : driver_id
            </p>_____________
            <p>Approval status API : </p>
            <p>
                {{ $app_url }}/api/driver/approval</p>------Status:Done-------
            <p>
                parameteres : email
            </p>_____________
            <p>Driver Profile API : </p>
            <p>
                {{ $app_url }}/api/driver/profile</p>------Status:Done-------
            <p>
                parameteres : driver_id
            </p>_____________
            <p>Update driver API : </p>
            <p>
                {{ $app_url }}/api/driver/update</p>------Status:Done-------
            <p>
                parameteres : driver_id , gender ,dob ,country_id ,city_id ,postal_code ,mobile_number,licence_file,
                address_file
                photo
            </p>_____________
            <p>driver photo API : </p>
            <p>
                {{ $app_url }}/api/driver/update_photo</p>------Status:Done-------
            <p>
                parameteres : driver_id , photo
            </p>_____________
            <p>driver vehicle profile API : </p>
            <p>
                {{ $app_url }}/api/driver/update_vehicle_profile</p>------Status:Done-------
            <p>
                parameteres : driver_id , vehicle_profile
            </p>_____________
            <p>driver changepassword API : </p>
            <p>
                {{ $app_url }}/api/driver/change_password</p>------Status:Done-------
            <p>
                parameteres : driver_id , password, old_password
            </p>_____________
            <p>driver email Sentcode API : </p>
            <p>
                {{ $app_url }}/api/driver/check_sent_code</p>------Status:Done-------
            <p>
                parameteres : email , sentcode
            </p>_____________
            <p>driver add vehicle API : </p>
            <p>
                {{ $app_url }}/api/driver/add_vehicle</p>
            ------Status:Done-------
            <p>
                parameteres : driver_id ,vehicle_name, type_id , vehicle_number , seats , vehicle_picture ,
                vehicle_document
            </p>_____________
            <p>driver add vehicle API : </p>
            <p>
                {{ $app_url }}/api/driver/update_vehicle</p>------Status:Done-------
            <p>
                parameteres : driver_id
            </p>_____________
            <p>driver add bank detail API : </p>
            <p>
                {{ $app_url }}/api/driver/add_bank_details</p>------Status:Done-------
            <p>
                parameteres :
                driver_id,bank_id,bank_payee,bank_account,bank_ifsc
            </p>_____________
            <p>driver get bank detail API : </p>
            <p>
                {{ $app_url }}/api/driver/get_bank_details</p>------Status:Done-------
            <p>
                parameteres : driver_id
            </p>_____________
            <p>driver update bank detail API : </p>
            <p>
                {{ $app_url }}/api/driver/update_bank_details</p>------Status:Done-------
            <p>
                parameteres : driver_id
            </p>_____________
            <p>driver Set trip location API : </p>
            <p>
                {{ $app_url }}/api/driver/add_trip</p>------Status:Done-------
            <p>
                parameteres : driver_id, from_title, from_lat, from_lng, from_address, to_title, to_lat, to_lng,
                to_address , datetime [2018-11-01 10:39:53] ,end_datetime [2018-11-01 10:39:53]
            </p>_____________
            <p>driver update trip location API : </p>
            <p>
                {{ $app_url }}updateDrivertrip</p>
            <p>
                parameteres : id , delaytime(yes) , cancel_reason
            </p>_____________
            <p>driver end / change status trip location API : </p>
            <p>
                {{ $app_url }}updateDrivertrip</p>
            <p>
                parameteres : id , status ['pending','active','deactive','ongoing','cancel'] ,trip_map_screenshot
            </p>_____________
            <p>driver delete trip location API : </p>
            <p>
                {{ $app_url }}/api/driver/delete_trip</p>------Status:Done-------
            <p>
                parameteres : trip_id
            </p>_____________
            <p>Get all driver current / past /upcoming API : </p>
            <p>
                {{ $app_url }}myDrivertrip</p>
            <p>
                parameteres : driver_id, trip_type [current / past /upcoming / history] , sort_by (sort_time ,
                sort_location)
            </p>_____________
            <p>Single driver trip API : </p>
            <p>
                {{ $app_url }}/api/driver/get_trip</p>------Status:Done-------
            <p>
                parameteres : trip_id
            </p>_____________
            <p>Get vehicle data API : </p>
            <p>
                {{ $app_url }}/api/get_vehicle</p>-----Status:Done-------
            <p>
                parameteres : driver_id
            </p>_____________
            <p>delete vehicle image API : </p>
            <p>
                {{ $app_url }}deleteVehicleplate</p>-----Status:Done-------
            <p>
                parameteres : id
            </p>_____________
            <p>Trip user list API : </p>
            <p>
                {{ $app_url }}tripUserlist</p>
            <p>
                parameteres : trip_id , countBookedseats , countRemainingseats
            </p>_____________
            <p>Trip detail screen API : </p>
            <p>
                {{ $app_url }}tripDetails</p>------Status:Done-------
            <p>
                parameteres : trip_id
            </p>_____________
            <p>Ratting detail screen API : </p>
            <p>
                {{ $app_url }}rattingDetails</p>
            <p>
                parameteres : driver_id
            </p>_____________
            <p>Document screen API : </p>
            <p>
                {{ $app_url }}drvierDocument</p>
            <p>
                parameteres : driver_id , driving_livence , address_proof , photo_type
            </p>_____________
            <p>delete driver Document API : </p>
            <p>
                {{ $app_url }}deleteDocuments</p>
            <p>
                parameteres : id
            </p>_____________
            <p>Get driver Document API : </p>
            <p>
                {{ $app_url }}getDriverdocuments</p>
            <p>
                parameteres : driver_id
            </p>_____________
            <p>Driver last location API : </p>
            <p>{{ $app_url }}lastLocation</p>
            <p>parameteres : trip_id,last_lat , last_lng</p>
            _____________
            <p>Country API : </p>
            <p>{{ $app_url }}/api/get_countries</p>
            _____________
            <p>City API : </p>
            <p>{{ $app_url }}/api/get_cities</p>
            <p>parameteres : country_id</p>
            _____________
            <p>Onboard userlist API : </p>
            <p>{{ $app_url }}onboardUserlist</p>
            <p>parameteres : trip_id , user_id [1,2,3,..]</p>
            _____________
            <p>All status API : </p>
            <p>{{ $app_url }}allApprovelStatus</p>
            <p>parameteres : driver_id</p>
            _____________
            <p>Trip locations API : </p>
            <p>{{ $app_url }}Triplocations</p>
            _____________
            <p>get Onboard user list API : </p>
            <p>{{ $app_url }}getOnboardlist</p>
            <p>parameteres : trip_id</p>
            ____________
        </div>
    </div>
</body>

</html>