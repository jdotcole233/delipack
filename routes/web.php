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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboardheader', function(){
    return view('systemheaders/dashboardheaders');
});


Route::get('/maindashboard', 'CompanyController@totalSales');




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


Route::get('/dashboardprofile', 'CompanyController@profilePage');

Route::get('/getridersinformation', 'riderController@ridersinformation');


Route::post('/registerrider', 'riderController@func_registerrider');
Route::post('/uploadriderphoto', 'riderController@uploadRiderprofile');
Route::post('/assignedmotrorbiketorider','riderController@insertRiderAndAssign');
Route::get('/editmotorinformation/{id}', 'rideController@motorinformation');
Route::post('/editrideinformation', 'rideController@editmotorinformation');


Route::post('/editridersprofile', 'riderController@editriderprofile');
Route::post('/unassignedmotorbike', 'riderController@unassignbiker');
Route::post('/authenticatedriver', 'riderController@authenticateDriver');
Route::post('/updatepassword', 'riderController@changePassword');

Route::post('/registercutomer', 'customerController@registerCustomer');

Route::post('/registerride', 'rideController@regRide');
Route::get('/gerregrides','rideController@getregRides');
Route::get('/getTransactionsforcompany', 'CompanyController@transactionquery');
Route::get('/getsingleriderinformation/{id}','CompanyController@singletransactionquery');
Route::post('/queryCompanyTransactionData','CompanyController@queryCompanyData');
Route::post('/gettotalsales','CompanyController@totalSales');


Route::post('/companydata','customerController@companyInformation');
Route::post('/updateTransaction', 'customerController@updateCustomerTransaction');
Route::post('/ratedelivery', 'customerController@ratedeliverycompany');
Route::post('/customertransactionhistory', 'customerController@getcustomertransactions');


Route::post('/customer_login', 'customerController@authenticateUser');

Route::post('/sendandroidcustomerreport','customerController@customerAndroidReport');
Route::get('/getridersalesdfortoday/{id}','CompanyController@getridersalesfortoday');
Route::get('/deactivteRider/{id}','riderController@deactivateRider');
Route::get('/deleteBike/{id}','rideController@deleteBike');
Route::get('/getcompanybikesforassignment','riderController@getCompanyRidersToAssign');
Route::post('/updateProfile','CompaanyController@updateProfile');