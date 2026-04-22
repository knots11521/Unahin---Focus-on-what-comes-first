<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FocusController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home redirect to login or tasks
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('tasks.index');
    }
    return view('index');
})->name('index');

// Route::view('/', 'index')->name('index');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard and tasks (protected routes)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    // Tasks resource routes
    Route::resource('tasks', TaskController::class);

    // Toggle task completion
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');

    // Focus suggestion
    Route::get('/focus/suggest', [FocusController::class, 'suggest'])->name('focus.suggest');
});

// About page (public)
Route::get('/about', function () {
    return view('pages.about');
})->name('about');
