<?php

use App\Http\Controllers\Admin\AuthenticationController;
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
    // Dashboard - redirect ke halaman sineas management
    Route::get('/dashboard', function() {
        return view('admin.dashboard.index');
    })->name('admin.dashboard.index');

    // Proses logout
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('admin.logout');

    // Routes untuk Sineas Management
    Route::prefix('sineas')->name('admin.sineas.')->group(function () {
        Route::get('/', [SineasController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [SineasController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SineasController::class, 'update'])->name('update');
        Route::delete('/{id}', [SineasController::class, 'destroy'])->name('destroy');
    });
});
