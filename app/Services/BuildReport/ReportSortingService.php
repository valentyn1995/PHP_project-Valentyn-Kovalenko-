<?php

declare(strict_types=1);

namespace App\Services\BuildReport;

/**
 * Class ReportSortingService
 *
 * This class is responsible for sorting the report data for output.
 */
class ReportSortingService
{
    /**
     * Constructs a new ReportSortingService instance.
     *
     * @param ReportService $reportService The ReportService instance for building the report data.
     */
    public function __construct(private ReportService $reportService)
    {
    }

    /**
     * Sorts the report data for output based on lap times.
     *
     * @param string $pathToFile The path to the input folder containing necessary files.
     * @param string|null $sortDirection The sort direction ('asc' for ascending, 'desc' for descending).
     * @return array The sorted report data.
     */
    public function sortingForOutput(string $pathToFile, ?string $sortDirection): array
    {
        $reportData = $this->reportService->buildingReport($pathToFile);

        $sortFunction = function ($time1, $time2) {
            $time1ForSort = $time1['lap_time'];
            $time2ForSort = $time2['lap_time'];

            if ($time1ForSort == $time2ForSort) {
                return 0;
            }

            return ($time1ForSort < $time2ForSort) ? -1 : 1;
        };

        uasort($reportData, $sortFunction);

        if ($sortDirection === 'desc') {
            $reportData = array_reverse($reportData, true);
        }

        return $reportData;
    }
}