<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\\Http\\Controllers\\Api'], function () {

    Route::get('/about', 'AboutController@index');
    Route::get('/clients', 'ContentController@clients');
    Route::get('/services', 'ContentController@services');
        Route::get('/Prviacy-ploice', 'ContentController@privacy');
                Route::get('/show', 'ContentController@show');
    Route::get('/setting', 'ContentController@contactUs');

                


    Route::get('/company-services', 'ContentController@companyServices');
    Route::get('/company-services/{id}', 'ContentController@companies');
    Route::get('/counters', 'ContentController@counters');
    Route::get('/objectives', 'ContentController@objectives');
    Route::get('/about-company', 'ContentController@about');
    Route::post('/rate-request', 'RateRequestsController@store');
    Route::get('/tracking', 'RateRequestsController@tracking');


    Route::get('/apartment-goal', 'CategoriesController@apartmentGoal');
    Route::get('/apartment-type', 'CategoriesController@apartmentType');
    Route::get('/apartment-entity', 'CategoriesController@apartmentEntity');
    Route::get('/apartment-usage', 'CategoriesController@apartmentUsage');

});
