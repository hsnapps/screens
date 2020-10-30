<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
// Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/screen/{id?}', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('screens')->group(function () {
        Route::get('{screen?}', 'ScreenController@index')->name('screens.index');
        Route::get('show/{screen}', 'ScreenController@show')->name('screens.show');
    });

    Route::prefix('schedules')->group(function () {
        Route::get('', 'ScheduleController@index')->name('schedules.index');
        Route::get('download', 'ScheduleController@download')->name('schedules.download');
        Route::post('upload', 'ScheduleController@upload')->name('schedules.upload');
    });

    Route::get('timing', 'TimingController@show')->name('timing.get');
    Route::post('timing', 'TimingController@update')->name('timing.post');

    Route::resource('users', 'UserController')->only(['index', 'update', 'destroy', 'store']);
    Route::get('users/table', 'UserController@loadUsers')->name('users.table');
    Route::post('users/password', 'UserController@changePassword')->name('users.password');

    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/about', 'HomeController@about')->name('about');
});

