<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

// Route for the homepage
Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks/todays', [TaskController::class, 'getTodaysTasks']);

    // Route for managing projects
    Route::resource('projects', ProjectController::class);
    
    // Route for managing tasks within a project
    Route::resource('projects.tasks', TaskController::class)->shallow();
    
    // Route for searching projects
    Route::get('search', [ProjectController::class, 'search'])->name('projects.search');
});



