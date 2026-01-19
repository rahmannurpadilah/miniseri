<?php

use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FolioController;
use App\Http\Controllers\Admin\SineasController;
use Illuminate\Support\Facades\Route;

// Route untuk login (tidak perlu middleware auth)
Route::prefix('admin')->group(function() {
    // Halaman login
    Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('admin.login');
    
    // Proses login
    Route::post('/login', [AuthenticationController::class, 'login'])->name('admin.login.store');
});

// Route yang memerlukan autentikasi
Route::prefix('admin')->middleware('authentication')->group(function() {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Proses logout
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('admin.logout');

    // Routes untuk Sineas Management
    Route::prefix('sineas')->name('admin.sineas.')->group(function () {
        Route::get('/', [SineasController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [SineasController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SineasController::class, 'update'])->name('update');
        Route::delete('/{id}', [SineasController::class, 'destroy'])->name('destroy');
    });

    // Routes untuk Folio Management
    Route::prefix('folios')->name('admin.folios.')->group(function () {
        Route::get('/', [FolioController::class, 'index'])->name('index');
        Route::get('/create', [FolioController::class, 'create'])->name('create');
        Route::post('/', [FolioController::class, 'store'])->name('store');
        Route::get('/{folio}', [FolioController::class, 'show'])->name('show');
        Route::get('/{folio}/edit', [FolioController::class, 'edit'])->name('edit');
        Route::put('/{folio}', [FolioController::class, 'update'])->name('update');
        Route::post('/{folio}/toggle-favorite', [FolioController::class, 'toggleFavorite'])->name('toggleFavorite');
        Route::delete('/{folio}', [FolioController::class, 'destroy'])->name('destroy');
    });
});
