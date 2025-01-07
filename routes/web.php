<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

Route::get('/', fn() => redirect('/dashboard'));

Route::middleware('auth')->group(function() {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

    Route::prefix('/products')->name('products.')->controller(ProductController::class)->group(function() {

        Route::get('/', 'index')->name('index');
        Route::get('/{product}', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');

    });

});


Route::middleware('guest')->prefix('/auth')->name('auth.')->controller(AuthController::class)->group(function() {

    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/login', 'login')->name('store.login');

    Route::get('/register', 'showRegister')->name('show.register');
    Route::post('/register', 'register')->name('store.register');

});
