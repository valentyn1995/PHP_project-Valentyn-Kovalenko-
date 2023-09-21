<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BuildReport\ProcessDataRacerService;
use App\Services\BuildReport\ReportSortingService;
use App\Services\BuildReport\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(
        private ReportSortingService $reportSortingService,
        private ProcessDataRacerService $processDataRacerService,
        private ReportService $reportService
    ) {

    }

    public function showStatistics(Request $request)
    {
        $pathToFile = base_path('files_for_report');
        $sortDirection = $request->input('order', 'asc');

        $sortedReportData = $this->reportSortingService->sortingForOutput($pathToFile, $sortDirection);

        return view('report.statistics', ['reportData' => $sortedReportData]);
    }

    public function showDriversName(Request $request)
    {
        $pathToFile = base_path('files_for_report');
        $sortDirection = $request->input('order', 'asc');

        $sortedReportDataWithName = $this->reportSortingService->sortingForOutput($pathToFile, $sortDirection);

        $driverId = $request->input('driver_id');

        if ($driverId) {
            return $this->showDriverInfo($driverId);
        }

        return view('report.drivers', ['sortedReportDataWithName' => $sortedReportDataWithName]);
    }

    public function showDriverInfo(string $driverId): mixed
    {
        $pathToFile = base_path('files_for_report');

        $sortedReportDataAboutDriver = $this->reportService->buildingReport($pathToFile);

        if (isset($sortedReportDataAboutDriver[$driverId])) {
            $driverInfo = $sortedReportDataAboutDriver[$driverId];
            return view('report.driver_info', ['driverInfo' => $driverInfo]);
        } else {

            return view('report.driver_info', ['driverInfo' => null]);
        }
    }
}