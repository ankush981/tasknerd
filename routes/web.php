<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/projects', function(){
    $projects = App\Project::all();
    return view('projects.index', compact('projects'));
});

Route::post('/projects', function(){
    App\Project::create(request(['title', 'description']));
});
