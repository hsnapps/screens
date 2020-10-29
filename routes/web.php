<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/screen/{id}', function () {
    return view('welcome');
});
Route::resource('users', 'UserController')->only(['index', 'update', 'destroy', 'store']);
Route::get('users/table', 'UserController@loadUsers')->name('users.table');
Route::get('/', 'HomeController@index')->name('home');
