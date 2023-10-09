<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/report', [ReportController::class, 'showStatistics'])->name('report.statistics');

Route::get('/report/drivers', [ReportController::class, 'showDriversName'])->name('report.drivers');

Route::get('/report/drivers/{driver_id}', [ReportController::class, 'showDriverInfo'])->name('report.driver_info');