<?php

declare(strict_types=1);

namespace App\Services\BuildReport;

/**
 * Class ReportService
 *
 * This class is responsible for building a report by orchestrating data extraction, calculation, and formatting.
 */
class ReportService
{
     /**
     * Constructs a new ReportService instance.
     *
     * @param ReportDataService $reportDataService The ReportDataService instance for data extraction and processing.
     * @param CalculateDifferenceTime $calculateDifferenceTime The CalculateDifferenceTime instance for time calculations.
     * @param GenerateDataForPrinting $generateDataForPrinting The GenerateDataForPrinting instance for data formatting.
     */
    public function __construct(
        private ReportDataService $reportDataService,
        private CalculateDifferenceTime $calculateDifferenceTime,
        private GenerateDataForPrinting $generateDataForPrinting
    ) {

    }

    /**
     * Builds a report by orchestrating data extraction, calculation, and formatting.
     *
     * @param string $inputFolderPath The path to the input folder containing necessary files.
     * @return array An array containing the formatted report data.
     */
    public function buildingReport(string $inputFolderPath): array
    {
        $extractedDataFromFile = $this->reportDataService->extractingDataFromFiles($inputFolderPath);

        $differenceTimeArray = $this->calculateDifferenceTime->calculatingDifferenceTime($extractedDataFromFile['arrayStart'], $extractedDataFromFile['arrayEnd']);

        $reportDataForPrinting = $this->generateDataForPrinting->formingDataForPrinting($extractedDataFromFile['resultNameRacer'], $differenceTimeArray);

        return $reportDataForPrinting;
    }
}