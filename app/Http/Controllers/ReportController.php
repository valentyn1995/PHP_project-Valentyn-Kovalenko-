<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BuildReport\ProcessDataRacerService;
use App\Services\BuildReport\ReportSortingService;
use App\Services\BuildReport\ReportService;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function __construct(
        private ReportSortingService $reportSortingService,
        private ProcessDataRacerService $processDataRacerService,
        private ReportService $reportService,
    ) {

    }

    public function showStatistics(Request $request)
    {
        $sortDirection = $request->input('order', 'asc');

        $sortedReportData = Report::orderBy('lap_time', $sortDirection)->get();

        return view('report.statistics', ['reportData' => $sortedReportData]);
    }

    public function showDriversName(Request $request)
    {
        $sortedReportDataWithName = Report::all();
        $driverId = $request->input('driver_id');

        if ($driverId) {
            return $this->showDriverInfo($driverId);
        }

        return view('report.drivers', ['sortedReportDataWithName' => $sortedReportDataWithName]);
    }

    public function showDriverInfo(string $driverId): mixed
    {
        $driverInfo = Report::where('drivers_code', $driverId)->first();

        if ($driverInfo) {
            return view('report.driver_info', ['driverInfo' => $driverInfo]);
        } else {

            return view('report.driver_info', ['driverInfo' => null]);
        }
    }
}