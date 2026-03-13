<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BestRecordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinePerformanceController;
use App\Http\Controllers\MarqueeTextController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PatternHistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SystemManagerController;

use Illuminate\Support\Facades\Route;
 
Route::get('/', fn () => redirect()->route('dashboards.index'));

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route - dashboard
Route::resource('dashboards', DashboardController::class);

Route::get('/system-managers', [SystemManagerController::class, 'index'])->name('system-managers.index');

// Route - Settings
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/system-managers', [SystemManagerController::class, 'index'])->name('system-managers.index');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

});

Route::resource('products', ProductController::class);

Route::resource('best-records', BestRecordController::class);

// Route - Line Performance
Route::resource('/line-performance', LinePerformanceController::class);

// Rute untuk mengambil tabel produk
Route::get('/fetch-products-table', [DashboardController::class, 'fetchProductsTable'])->name('products.fetchTable');

// Route - Marquee Text
Route::post('/marqueeText/update', [MarqueeTextController::class, 'update'])->name('marqueeText.update');

// Pattern Histories
Route::resource('/pattern-histories', PatternHistoryController::class);