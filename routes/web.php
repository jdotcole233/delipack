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
    return view('auth/login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/dashboardheader', function(){
//     return view('systemheaders/dashboardheaders');
// });


Route::get('/maindashboard', 'CompanyController@totalSales');




Route::get('/riders','riderController@getallrides');



Route::get('/aboutriders/{id}', 'riderController@riderinformation');
Route::get('/editriderinformation/{id}', 'riderController@ridereditinformation');

Route::get('/rides', function(){
    return view('dashboard.rides.rides');
});

Route::get('/deliveries','CompanyController@renderDeliveries');

Route::get('/reports', function(){
    return view('dashboard.reports.datareports');
});

Route::get('/customers', function(){
    return view('dashboard.customers.company_customer');
});


Route::get('/dashboardprofile', 'CompanyController@profilePage');

Route::get('/getridersinformation', 'riderController@ridersinformation');


Route::post('/registerrider', 'riderController@func_registerrider');
Route::post('/uploadriderphoto', 'riderController@uploadRiderprofile');
Route::post('/assignedmotrorbiketorider','riderController@insertRiderAndAssign');
Route::get('/editmotorinformation/{id}', 'rideController@motorinformation');
Route::post('/editrideinformation', 'rideController@editmotorinformation');


Route::post('/editridersprofile', 'riderController@editriderprofile');
Route::post('/unassignedmotorbike', 'riderController@unassignbiker');

Route::post('/registerride', 'rideController@regRide');
Route::get('/gerregrides','rideController@getregRides');
Route::get('/getTransactionsforcompany', 'CompanyController@transactionquery');
Route::get('/getsingleriderinformation/{id}','CompanyController@singletransactionquery');
Route::post('/queryCompanyTransactionData','CompanyController@queryCompanyData');
Route::post('/gettotalsales','CompanyController@totalSales');




Route::post('/upload_manual_record','CompanyController@manual_record_upload');
Route::get('/getridersalesdfortoday/{id}','CompanyController@getridersalesfortoday');
Route::get('/deactivteRider/{id}','riderController@deactivateRider');
Route::get('/deleteBike/{id}','rideController@deleteBike');
Route::get('/getcompanybikesforassignment','riderController@getCompanyRidersToAssign');
Route::post('/updateProfile','CompanyController@updateProfile');
Route::post('/updatepassword','CompanyController@updatepassword');
Route::get('/getcompanyridersids', 'CompanyController@companyridersIdentifications');
