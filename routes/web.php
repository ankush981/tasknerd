<?php

use Illuminate\Support\Facades\Route;

\App\Project::created(function($project){
    \App\Activity::create([
        'project_id' => $project->id,
        'description' => 'created'
    ]);
});


\App\Project::updated(function($project){
    \App\Activity::create([
        'project_id' => $project->id,
        'description' => 'updated'
    ]);
});


Route::group(['middleware' => 'auth'], function() {
    Route::get('/projects', 'ProjectsController@index');
    Route::get('/projects/create', 'ProjectsController@create');
    Route::get('/projects/{project}', 'ProjectsController@show');
    Route::get('/projects/{project}/edit', 'ProjectsController@edit');
    Route::post('/projects', 'ProjectsController@store');
    Route::patch('/projects/{project}', 'ProjectsController@update');
    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
    Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');
    
    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
