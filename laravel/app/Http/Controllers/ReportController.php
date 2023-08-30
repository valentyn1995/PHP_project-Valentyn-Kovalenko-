<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BuildReport\ProcessDataRacerService;
use Illuminate\Http\Request;
use App\Services\BuildReport\ReportSortingService;
use App\Services\BuildReport\ReportService;

class ReportController extends Controller
{
    public function __construct(
        private ReportSortingService $reportSortingService,
        private ProcessDataRacerService $processDataRacerService,
        private ReportService $reportService
    ) {

    }

    public function showStatistics()
    {
        $pathToFile = base_path('Files_for_task');
        $sortDirection = request()->input('order', 'asc');

        $sortedReportData = $this->reportSortingService->sortingForOutput($pathToFile, $sortDirection);

        return view('report.statistics', ['reportData' => $sortedReportData]);
    }

    public function showDriversName()
    {
        $pathToFile = base_path('Files_for_task');
        $sortDirection = request()->input('order', 'asc');

        $sortedReportDataWithName = $this->reportSortingService->sortingForOutput($pathToFile, $sortDirection);

        // Отримайте параметр driver_id з URL
        $driverId = request()->input('driver_id');

        // Якщо передано параметр driver_id, перенаправте на сторінку з інформацією про водія
        if ($driverId) {
            return $this->showDriverInfo($driverId);
        }

        return view('report.drivers', ['sortedReportDataWithName' => $sortedReportDataWithName]);
    }

    public function showDriverInfo($driverId)
    {
        $pathToFile = base_path('Files_for_task');

        $sortedReportDataAboutDriver = $this->reportService->buildingReport($pathToFile);

        // Перевіряємо, чи є інформація про водія з вказаним driver_id
        if (isset($sortedReportDataAboutDriver[$driverId])) {
            $driverInfo = $sortedReportDataAboutDriver[$driverId];
            return view('report.driver_info', ['driverInfo' => $driverInfo]);
        } else {
            // Водія з таким driver_id не знайдено, можливо, вам потрібно відобразити повідомлення про помилку
            return view('report.driver_info', ['driverInfo' => null]);
        }
    }
}