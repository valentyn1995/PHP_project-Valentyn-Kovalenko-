<?php

declare(strict_types=1);

namespace App\Services\ConsoleServices;

use App\Services\BuildReport\ReportSortingService;
use Illuminate\Http\Request;
use App\Models\Report;

class CreateDataService
{
    public function __construct(private ReportSortingService $reportSortingService)
    {

    }

    public function create(Request $request): void
    {
        $pathToFile = base_path('files_for_report');
        $sortDirection = $request->input('order', 'asc');

        $sortedReportDataWithName = $this->reportSortingService->sortingForOutput($pathToFile, $sortDirection);

        foreach ($sortedReportDataWithName as $key => $value) {
            Report::updateOrCreate([
                'drivers_code' => $key,
                'name' => $value['nameRacer'],
                'team' => $value['team'],
                'lap_time' => $value['lap_time']
            ]);
        }
    }
}