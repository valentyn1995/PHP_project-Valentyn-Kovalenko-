<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BuildReport\ProcessDataRacerService;
use App\Services\BuildReport\ReportSortingService;
use App\Services\BuildReport\ReportService;
use Illuminate\Http\Request;
use App\Services\Repository\ReportRepository;

class ReportController extends Controller
{
    public function __construct(
        private ReportSortingService $reportSortingService,
        private ProcessDataRacerService $processDataRacerService,
        private ReportService $reportService,
        private ReportRepository $reportRepository
    ) {

    }

    public function showStatistics(Request $request)
    {
        $sortDirection = $request->input('order', 'asc');
        $column = 'lap_time';

        $sortedReportData = $this->reportRepository->getDataWithOrder($column, $sortDirection);
print_r($sortedReportData);
        return view('report.statistics', ['reportData' => $sortedReportData]);
    }

    public function showDriversName(Request $request)
    {
        $sortedReportDataWithName = $this->reportRepository->getAll();

        $driverId = $request->input('driver_id');

        if ($driverId) {

            return $this->showDriverInfo($driverId);
        }

        return view('report.drivers', ['sortedReportDataWithName' => $sortedReportDataWithName]);
    }

    public function showDriverInfo(string $driverId): mixed
    {
        $column = 'drivers_code';

        $driverInfo = $this->reportRepository->getWithFilters($column, $driverId);

        if ($driverInfo) {

            return view('report.driver_info', ['driverInfo' => $driverInfo]);
        } else {

            return view('report.driver_info', ['driverInfo' => null]);
        }
    }
}