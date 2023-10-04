<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*-*-*-*-*-*-*-*-*--*--*---** Agent Panel URL *---*-*--*-*-*-*-*-*-*-*-*-*-**/

Route::get('lang/{locale}', function ($locale) {
    Session::put('lang', $locale);
    App::setLocale($locale);
    return redirect()->back();
});


Route::group(['namespace' => 'App\\Http\\Controllers\\Admin', 'as' => 'admin.'], function () {
    Route::post('/login', 'LoginController@postLogin')->name('login');
    Route::get('/login', 'LoginController@showLoginForm')->name('showLogin');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('403', function () {
            return view('403');
        });
        Route::get('404', function () {
            return view('404');
        });
        Route::get('makeAsread', function () {
            auth()->user()->unreadNotifications->markAsRead();
        });
        Route::get('notifucation', function () {
            return view('admin.evaluation.transactions.notifucation');
        });
        Route::get('notification/delete/{id}', 'Evaluation\\dailyController@deletenotification');

        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::resource('services', 'ServicesController');
        Route::resource('privacy', 'PrivacyController');

        Route::resource('about', 'AboutController');
        Route::resource('clients', 'ClientsController');
        Route::resource('counters', 'CountersController');
        Route::resource('objectives', 'ObjectivesController');
        Route::resource('rates', 'RateRequestsController');
        Route::resource('companies', 'CompaniesController');
        Route::put('rates/update/{id}', 'RateRequestsController@changeStatus')
            ->name('rates.update-status');

        Route::resource('evaluation-companies', 'Evaluation\\CompaniesController');
        Route::resource('evaluation-employees', 'Evaluation\\EmployeesController');
        Route::resource('evaluation-transactions', 'Evaluation\\TransactionsController');
        Route::put('evaluation-transactions/update/{id}', 'Evaluation\\TransactionsController@changeStatus')->name('evaluation-transactions.update-status');
        Route::get('/evaluation-transactions/Delete/File/{id}', 'Evaluation\\TransactionsController@DeleteFile');
        //

        Route::get('evaluationtransactions/2', 'Evaluation\\TransactionsController@index2');

        //

        // sh
        Route::get('daily-transactions', 'Evaluation\\dailyController@index')->name('daily-transactions');
        Route::get('company_transactions', 'Evaluation\\dailyController@company_transactions')->name('company_transactions');
        Route::get('user_transactions', 'Evaluation\\dailyController@user_transactions')->name('user_transactions');
        Route::get('Review-transactions', 'Evaluation\\dailyController@Review_transactions')->name('Review');
        Route::get('Company-All-Transactions', 'Evaluation\\dailyController@AllCompany_transactions')->name('AllCompany_transactions');
        Route::get('single-transactions/{id}', 'Evaluation\\dailyController@single_transactions')->name('single_transactions');
        Route::get('exportxlsx/', 'Evaluation\\dailyController@export');


        //

        Route::resource('/goals', 'Category\\GoalController');
        Route::resource('/types', 'Category\\TypeController');
        Route::resource('/entities', 'Category\\EntityController');
        Route::resource('/usages', 'Category\\UsageController');

        Route::resource('/cities', 'Category\\CityController');
        Route::resource('/roles', 'RolesController');
        Route::resource('/admins', 'AdminsController');

        Route::resource('company-services', 'CompanyServicesController');
        Route::resource('media', 'MediaController');

        Route::get('/', 'LoginController@home')->name('home');
        Route::get('/profile', 'LoginController@getProfile')->name('profile');
        Route::put('/profile', 'LoginController@updateProfile')->name('profile.update');

        Route::resource('settings', 'SettingsController')->only(
            [
                'index', 'update',
            ]
        );

        Route::get('/our_backup_database', 'BackupDBController@our_backup_database')->name('our_backup_database');
        Route::get('/backup_database', 'BackupDBController@backup_database')->name('backup_database');
        Route::get('/chick_instrument_number/{value}', 'Evaluation\\TransactionsController@chick_instrument_number');


    });
});
