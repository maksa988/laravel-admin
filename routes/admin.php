<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::any('/cache/clear', 'DashboardController@clearCache')->name('cache.clear');