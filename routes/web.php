<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinePerformanceController;
use App\Http\Controllers\MarqueeTextController;
use App\Http\Controllers\SettingController;

use Illuminate\Support\Facades\Route;
 
Route::get('/', fn () => redirect()->route('dashboards.index'));

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