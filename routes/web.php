<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/projects', 'ProjectsController@index');
    Route::get('/projects/{project}', 'ProjectsController@show');
    Route::post('/projects', 'ProjectsController@store');
    
    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
