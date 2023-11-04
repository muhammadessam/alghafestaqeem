<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Artisan;
use setasign\Fpdi\Tcpdf\Fpdi;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');

    return "Cache cleared successfully";
});
Route::group(['namespace' => 'App\\Http\\Controllers\\Website', 'as' => 'website.'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/rate-request', 'RateRequestsController@show')->name('rate-request.show');
    Route::post('/rate-request', 'RateRequestsController@store')->name('rate-request.store');
    Route::get('/contactUs', 'HomeController@contactUs')->name('contactUs');
    Route::get('/Prviacy-ploice', 'HomeController@Prviacyploice')->name('Prviacy-ploice');
    Route::get('/tracking', 'RateRequestsController@tracking')->name('tracking');
    Route::get('/tracking_number', 'RateRequestsController@tracking_request_no')->name('tracking_number');


});

Route::get('/commands', function () {
    \Artisan::call('optimize');
    // \Artisan::call('storage:link');
    return \Artisan::call('db:seed --class=MainPermissionsTableDataSeeder --force');
    // return Artisan::call('migrate', ["--force" => true ]);
});
