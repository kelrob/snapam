<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'layouts.index')->name('index');
Route::post('/report', [ReportController::class, 'store'])->name('report');

Route::group(['prefix' => 'admin/auth'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
    Route::get('snap/create-admin', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('snap/create-admin', [RegisterController::class, 'register']);

//Password Confirm
    Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

// Password Reset Routes...
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/report', [App\Http\Controllers\HomeController::class, 'reports'])->name('home.report');
Route::post('/home/report/{report}/action', [HomeController::class, 'updateAction'])->name('home.report.updateAction');
Route::get('/home/report/{report}', [HomeController::class, 'report'])->name('home.report.one');
Route::get('/home/map/{id}', [HomeController::class, 'map']);
