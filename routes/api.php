<?php

use App\Http\Controllers\Api\ReportApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('report', [ReportApiController::class, 'getStatistics']);
    Route::get('report/drivers', [ReportApiController::class, 'getDriversName']);
    Route::get('/report/drivers/{driver_id}', [ReportApiController::class, 'getDriverInfo']);
});