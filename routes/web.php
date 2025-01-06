<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;

Route::get('/', fn() => redirect('/dashboard'));

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

Route::prefix('/products')->name('products.')->controller(ProductController::class)->group(function() {

    Route::get('/', 'index');
    Route::post('/', 'store');

});
