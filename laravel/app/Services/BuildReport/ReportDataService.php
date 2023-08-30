<?php

declare(strict_types=1);

namespace App\Services\BuildReport;

/**
 * Class ReportDataService
 *
 * This class is responsible for extracting and processing data from various files for generating a report.
 */
class ReportDataService
{
    /**
     * Constructs a new ReportDataService instance.
     *
     * @param ProcessDataLapService $processDataLapService The ProcessDataLapService instance for lap data.
     * @param ProcessDataRacerService $processDataRacerService The ProcessDataRacerService instance for racer data.
     */
    public function __construct(
        private ProcessDataLapService $processDataLapService,
        private ProcessDataRacerService $processDataRacerService
    ) {

    }

    /**
     * Extracts and processes data from various files in the specified input folder.
     *
     * @param string $inputFolderPath The path to the input folder containing necessary files.
     * @return array An array containing extracted and processed data.
     */
    public function extractingDataFromFiles(string $inputFolderPath): array
    {
        $startLogFile = "$inputFolderPath/start.log";
        $endLogFile = "$inputFolderPath/end.log";
        $abbreviationsFile = "$inputFolderPath/abbreviations.txt";

        $arrayStart = $this->processDataLapService->extractDataStartAndEnd($startLogFile);
        $arrayEnd = $this->processDataLapService->extractDataStartAndEnd($endLogFile);
        $resultNameRacer = $this->processDataRacerService->extractNameRacers($abbreviationsFile);

        return [
            'arrayStart' => $arrayStart,
            'arrayEnd' => $arrayEnd,
            'resultNameRacer' => $resultNameRacer
        ];
    }
}