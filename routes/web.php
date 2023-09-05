<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/report', [ReportController::class, 'showStatistics'])->name('report.statistics');

Route::get('/report/drivers', [ReportController::class, 'showDriversName'])->name('report.drivers');

Route::get('/report/drivers/{driver_id}', [ReportController::class, 'showDriverInfo'])->name('report.driver_info');