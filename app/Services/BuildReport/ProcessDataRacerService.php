<?php

declare(strict_types=1);

namespace App\Services\BuildReport;

/**
 * Class ProcessDataRacerService
 *
 * This class is responsible for processing racer data from a file.
 */
class ProcessDataRacerService
{
    /**
     * Constructs a new ProcessDataLapService instance.
     *
     * @param ExtractDataFromFile $extractDataFromFile The ExtractDataFromFile instance for extracting data.
     */ 
    public function __construct(private ExtractDataFromFile $extractDataFromFile)
    {

    }

    /**
     * Extracts racer data from the specified file.
     *
     * @param string $pathToFileRacers The path to the file containing racer data.
     * @return array An array containing racer names and team.
     */
    public function extractNameRacers(string $pathToFileRacers): array
    {
        $dataFromFile = $this->extractDataFromFile->extractingDataFromFile($pathToFileRacers);
        $arrayFromDataFile = explode("\n", $dataFromFile);

        $sortedRacerArray = [];
        foreach ($arrayFromDataFile as $item) {
            $parts = explode("_", $item, 2);
            if (count($parts) == 2) {
                $index = $parts[0];
                $value = $parts[1];
                $sortedRacerArray[$index] = $value;
            }
        }

        ksort($sortedRacerArray);

        return $sortedRacerArray;
    }
}