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

    Route::prefix('lectures')->group(function () {
        Route::get('index', 'LectureController@index')->name('lectures.index');
        Route::get('download', 'LectureController@download')->name('lectures.download');
    });

    Route::get('timing', 'TimingController@show')->name('timing.get');
    Route::post('timing', 'TimingController@update')->name('timing.post');

    Route::resource('users', 'UserController')->only(['index', 'update', 'destroy', 'store']);
    Route::get('users/table', 'UserController@loadUsers')->name('users.table');
    Route::post('users/password', 'UserController@changePassword')->name('users.password');

    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/about', 'HomeController@about')->name('about');
});

