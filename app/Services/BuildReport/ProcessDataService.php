<?php

declare(strict_types=1);

namespace App\Services\BuildReport;

/**
 * Class ProcessDataLapService
 *
 * This class is responsible for processing lap and racer data from a file.
 */
class ProcessDataService
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
     * Extracts lap start and end data from the specified file.
     *
     * @param string $pathToFileStartEnd The path to the file containing lap start and end data.
     * @return array An array containing lap start and end data.
     */
    public function extractDataStartAndEnd(string $pathToFileStartEnd): array
    {
        $dataFromFile = $this->extractDataFromFile->extractingDataFromFile($pathToFileStartEnd);
        $arrayFromDataFile = explode("\n", $dataFromFile);

        $sortArrayWithData = [];
        foreach ($arrayFromDataFile as $value) {
            $index = substr($value, 0, 3);
            $value = substr($value, 3);
            $sortArrayWithData[$index] = $value;
        }

        $arrayWithoutDate = [];
        foreach ($sortArrayWithData as $key => $dateAndTime) {
            $valueWithoutDate = substr($dateAndTime, 11);
            $arrayWithoutDate[$key] = $valueWithoutDate;
        }

        ksort($arrayWithoutDate);

        return $arrayWithoutDate;
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