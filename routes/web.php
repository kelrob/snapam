<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'layouts.index')->name('index');
Route::post('/report', [ReportController::class, 'store'])->name('report');

Route::group(['prefix' => 'admin/auth'], function () {
    Auth::routes();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/report', [App\Http\Controllers\HomeController::class, 'reports'])->name('home.report');
Route::post('/home/report/{report}/action', [HomeController::class, 'updateAction'])->name('home.report.updateAction');
Route::get('/home/report/{report}', [HomeController::class, 'report'])->name('home.report.one');
Route::get('/home/map/{id}', [HomeController::class, 'map']);
