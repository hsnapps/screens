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

    Route::get('timing', 'TimingController@show')->name('timing.get');
    Route::post('timing', 'TimingController@update')->name('timing.post');

    Route::resource('users', 'UserController')->only(['index', 'update', 'destroy', 'store']);
    Route::get('users/table', 'UserController@loadUsers')->name('users.table');
    Route::post('users/password', 'UserController@changePassword')->name('users.password');

    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/about', 'HomeController@about')->name('about');
});

