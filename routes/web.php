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
Auth::routes();

Route::get('/', function () {
    return view('inputDNS');
});
// Route::post('/namaDNS', 'DNSController@check_dns');
// Route::get('/viewDNS', function () {
//     return view('viewDNS');
// });

Route::group(['prefix' => 'DNSLookUp'], function () {
    // Route::post('/namaDNS', 'DNSController@check_dns');
    Route::post('/checkDNS', 'DNSController@check_dns');
    Route::get('/searchDNS', 'DNSController@search_dns');
    Route::get('/checknow/{id}', 'DNSController@checkdns_now');
    Route::get('/lastModify/{id}', 'DNSController@lastmodify_dns');
    Route::get('/storeDNS/{domain}', 'DNSController@store_dns');
    Route::get('/checknowDNS/{domain}', 'DNSController@update_dns');
    Route::get('/', function () {
        return view('inputDNS');
    })->name('/');
    Route::get('user/profile', 'UserProfileController@show')->name('profile');
    Route::get('/viewDNS', function () {
        return view('viewDNS');
    });
   

    

});

Route::get('json', 'DNSController@jeson');
