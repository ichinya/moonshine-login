<?php

use Ichinya\MoonshineLogin\Controllers\AuthenticateController;
use Ichinya\MoonshineLogin\Controllers\ForgotController;
use Ichinya\MoonshineLogin\Controllers\ProfileController;
use Ichinya\MoonshineLogin\Controllers\RegisterController;
use Ichinya\MoonshineLogin\Pages\ResetPasswordPage;

Route::controller(AuthenticateController::class)->group(function (): void {
    Route::get('/login', 'form')->middleware('guest')->name('login');
    Route::post('/login', 'authenticate')->middleware('guest')->name('authenticate');
    Route::delete('/logout', 'logout')->middleware('auth')->name('logout');
});
Route::controller(ForgotController::class)->middleware('guest')->group(function (): void {
    Route::get('/forgot', 'form')->name('forgot');
    Route::post('/forgot', 'reset');
    Route::get('/reset-password/{token}', static fn (ResetPasswordPage $page) => $page)->name('password.reset');
    Route::post('/reset-password', 'updatePassword')->name('password.update');
});
Route::controller(RegisterController::class)->middleware('guest')->group(function (): void {
    Route::get('/register', 'form')->name('register');
    Route::post('/register', 'store')->name('register.store');
});
Route::controller(ProfileController::class)->middleware('auth')->prefix('profile')->group(function (): void {
    Route::get('/', 'index')->name('profile');
    Route::post('/', 'update')->name('profile.update');
});
