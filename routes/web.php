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

Route::get('/dashboardheader', function(){
    return view('systemheaders/dashboardheaders');
});


Route::get('/maindashboard', function(){
    return view('dashboard.maindashboard');
});

Route::get('/riders','riderController@getallrides');



Route::get('/aboutriders/{id}', 'riderController@riderinformation');
Route::get('/editriderinformation/{id}', 'riderController@ridereditinformation');

Route::get('/rides', function(){
    return view('dashboard.rides.rides');
});

Route::get('/deliveries', function(){
    return view('dashboard.deliveries.deliveries');
});

Route::get('/reports', function(){
    return view('dashboard.reports.datareports');
});


Route::get('/dashboardprofile', function(){
    return view('dashboard.dashboardprofile');
});

Route::get('/getridersinformation', 'riderController@ridersinformation');


Route::post('/registerrider', 'riderController@func_registerrider');
Route::post('/uploadriderphoto', 'riderController@uploadRiderprofile');
Route::post('/assignedmotrorbiketorider','riderController@insertRiderAndAssign');
Route::get('/editmotorinformation/{id}', 'rideController@motorinformation');
Route::post('/editrideinformation', 'rideController@editmotorinformation');
Route::post('/editridersprofile', 'riderController@editriderprofile');
Route::post('/unassignedmotorbike', 'riderController@unassignbiker');

Route::post('/registercutomer', 'customerController@registerCustomer');

Route::post('/registerride', 'rideController@regRide');
Route::get('/gerregrides','rideController@getregRides');


Route::post('/customer_login', 'customerController@authenticateUser');