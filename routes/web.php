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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['register' => false]);

Route::get('job/approve/{token}', 'JobController@approve')->name('job.approve');

Route::get('job/reject/{token}', 'JobController@reject')->name('job.reject');;

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::resource('job', 'JobController');
});
