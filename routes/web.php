<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinePerformanceController;
use App\Http\Controllers\MarqueeTextController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PatternHistoryController;

use Illuminate\Support\Facades\Route;
 
Route::get('/', fn () => redirect()->route('dashboards.index'));

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route - dashboard
Route::resource('dashboards', DashboardController::class);

// Route - Settings
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

// Route - Line Performance
Route::get('/linePerformance/create', [LinePerformanceController::class, 'create'])->name('linePerformance.create');
Route::post('/linePerformance/store', [LinePerformanceController::class, 'store'])->name('linePerformance.store');
Route::get('/linePerformance/edit/{id}', [LinePerformanceController::class, 'edit'])->name('linePerformance.edit');
Route::put('/linePerformance/update/{id}', [LinePerformanceController::class, 'update'])->name('linePerformance.update');
Route::delete('/linePerformance/destroy/{id}', [LinePerformanceController::class, 'destroy'])->name('linePerformance.destroy');
Route::get('/linePerformance/search', [LinePerformanceController::class, 'search'])->name('linePerformance.search');

// Rute untuk mengambil tabel produk
Route::get('/fetch-products-table', [DashboardController::class, 'fetchProductsTable'])->name('products.fetchTable');

// Route - Marquee Text
Route::post('/marqueeText/update', [MarqueeTextController::class, 'update'])->name('marqueeText.update');

// Pattern Histories
Route::resource('/pattern-histories', PatternHistoryController::class);