<?php

declare(strict_types=1);

namespace App\Services\APIServices;

use App\Services\BuildReport\ReportSortingService;
use App\Services\BuildReport\ReportService;
use App\Services\APIServices\PathForApi;

class ReportForApi
{
    public function __construct(
        private ReportSortingService $reportSortingService,
        private ReportService $reportService,
        private PathForApi $pathForApi
    ) {

    }

    public function reportingForApi($sortDirection)
    {
        $pathToFile = $this->pathForApi->pathFormation();
        
        if ($sortDirection) {
            return $this->reportSortingService->sortingForOutput($pathToFile, $sortDirection);
        } elseif (!$sortDirection) {
            return $this->reportService->buildingReport($pathToFile);
        }
    }
}