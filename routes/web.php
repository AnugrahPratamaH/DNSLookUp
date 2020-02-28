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
    return view('inputDNS');
});
Route::post('/', 'DNSController@check_dns');
Route::get('/viewDNS', function () {
    return view('viewDNS');
});

Route::group(['prefix' => 'DNSLookUp'], function () {
    Route::get('/', function () {
        return view('inputDNS');
    });
    Route::get('/viewDNS', function () {
        return view('viewDNS');
    });
    Route::post('/', 'DNSController@check_dns');

});
