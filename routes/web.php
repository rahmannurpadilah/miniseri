<?php

use App\Http\Controllers\FolioController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SineasRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'index'])->name('homepage');

Route::get('/detail/profile/{hash}', [FolioController::class, 'show'])->name('profile.detail');

Route::post('/sineas/register', [SineasRegistrationController::class, 'store'])->name('sineas.register');

Route::get('/refresh-captcha', [FolioController::class, 'refreshCaptcha'])->name('refresh.captcha');