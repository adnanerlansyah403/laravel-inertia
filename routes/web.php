<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/projects', [DashboardController::class, 'projects'])->name('dashboard.projects');

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
