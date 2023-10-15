<?php

declare(strict_types=1);

namespace App\Services\ConsoleServices;

use App\Services\BuildReport\ReportSortingService;
use App\Services\Repository\ReportRepository;

class CreateDataService
{
    public function __construct(private ReportSortingService $reportSortingService, private ReportRepository $reportRepository)
    {

    }

    public function create($request): void
    {
        $pathToFile = base_path('files_for_report');
        $sortDirection = $request->input('order', 'asc');

        $sortedReportDataWithName = $this->reportSortingService->sortingForOutput($pathToFile, $sortDirection);

        $this->reportRepository->createData($sortedReportDataWithName);
    }
}