<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

// Route for the homepage
Route::get('/', function () {
    return redirect()->route('projects.index');
});

// Route for managing projects
Route::resource('projects', ProjectController::class);

// Route for managing tasks within a project
Route::resource('projects.tasks', TaskController::class)->shallow();

// Route for searching projects
Route::get('search', [ProjectController::class, 'search'])->name('projects.search');
