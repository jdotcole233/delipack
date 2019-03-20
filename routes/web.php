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

Route::get('/riders', function(){
    return view('dashboard.riders.riders');
});


Route::get('/aboutriders', function(){
    return view('dashboard.riders.aboutrider');
});

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