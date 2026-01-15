<?php

use App\Http\Controllers\Admin\SineasController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    // Dashboard - redirect ke halaman sineas management
    Route::get('/dashboard', function() {
        return redirect()->route('admin.dashboard.index');
    })->name('admin.dashboard.index');

    // Routes untuk Sineas Management
    Route::prefix('sineas')->name('admin.sineas.')->group(function () {
        Route::get('/', [SineasController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [SineasController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SineasController::class, 'update'])->name('update');
        Route::delete('/{id}', [SineasController::class, 'destroy'])->name('destroy');
    });

});
