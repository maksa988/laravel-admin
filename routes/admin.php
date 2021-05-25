<?php

use Illuminate\Support\Facades\Route;
use Maksa988\LaravelAdmin\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::any('/cache/clear', [DashboardController::class, 'clearCache'])->name('cache.clear');
