<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
// Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/screen/{id}', 'ScreenController@minitor')->name('monitor');

Route::middleware(['auth'])->group(function () {
    Route::prefix('screens')->group(function () {
        Route::get('{screen?}', 'ScreenController@index')->name('screens.index');
        Route::get('show/{screen}', 'ScreenController@show')->name('screens.show');
        Route::post('update/{screen}', 'ScreenController@update')->name('screens.update');
        Route::post('update-times/{screen}', 'ScreenController@updateTimes')->name('screens.update-times');
        Route::delete('remove-times/{screen}', 'ScreenController@removeTimes')->name('screens.update-remove');
    });

    Route::prefix('announcements')->group(function () {
        Route::post('create', 'AnnouncementController@create')->name('announcements.create');
        Route::put('update', 'AnnouncementController@update')->name('announcements.update');
        Route::post('change-active', 'AnnouncementController@changeActive')->name('announcements.change-active');
        Route::post('add-global', 'AnnouncementController@addGlobal')->name('announcements.global');
        Route::delete('delete', 'AnnouncementController@delete')->name('announcements.delete');
        Route::get('dialog', 'AnnouncementController@getDialog')->name('announcements.dialog');
    });

    Route::prefix('schedules')->group(function () {
        Route::get('', 'ScheduleController@index')->name('schedules.index');
        Route::get('download', 'ScheduleController@download')->name('schedules.download');
        Route::post('upload', 'ScheduleController@upload')->name('schedules.upload');
    });

    Route::prefix('instructors')->group(function () {
        Route::get('', 'InstructorController@index')->name('instructors.index');
        Route::get('show/{computer_id}', 'InstructorController@show')->name('instructors.show');
        Route::get('download', 'InstructorController@download')->name('instructors.download');
        Route::post('upload', 'InstructorController@upload')->name('instructors.upload');
        Route::post('upload-photo', 'InstructorController@uploadPhoto')->name('instructors.upload');
        Route::post('remove-photo', 'InstructorController@removePhoto')->name('instructors.remove');
    });

    // Route::get('timing', 'TimingController@show')->name('timing.get');
    // Route::post('timing', 'TimingController@update')->name('timing.post');

    Route::prefix('users')->group(function () {
        Route::get('', 'UserController@index')->name('users.index');
        Route::get('table', 'UserController@loadUsers')->name('users.table');
        Route::put('{user}', 'UserController@update')->name('users.update');
        Route::post('{user}', 'UserController@update')->name('users.edit');
        Route::post('', 'UserController@store')->name('users.store');
        Route::post('password', 'UserController@changePassword')->name('users.password');
        Route::post('screens/{user}', 'UserController@assignScreen')->name('users.screens');
    });

    // Route::resource('users', 'UserController')->only(['index', 'update', 'destroy', 'store']);

    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/about', 'HomeController@about')->name('about');
});

