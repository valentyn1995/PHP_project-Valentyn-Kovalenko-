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
     */
    public function __construct(
        private ReportDataService $reportDataService,
        private CalculateDifferenceTime $calculateDifferenceTime
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

        $reportDataForPrinting = $this->formingDataForPrinting($extractedDataFromFile['resultNameRacer'], $differenceTimeArray);

        return $reportDataForPrinting;
    }

    private function formingDataForPrinting(array $resultNameRacer, array $differenceTimeArray): array
    {
        $reportData = [];
        foreach ($resultNameRacer as $indexRacer => $valRacer) {
            if (isset($differenceTimeArray[$indexRacer])) {
                $arrayWithNameAndTeam = explode("_", $valRacer);
                $reportData[$indexRacer] = [
                    'nameRacer' => $arrayWithNameAndTeam[0],
                    'team' => $arrayWithNameAndTeam[1],
                    'lap_time' => $differenceTimeArray[$indexRacer],
                ];
            }
        }

        return $reportData;
    }
}