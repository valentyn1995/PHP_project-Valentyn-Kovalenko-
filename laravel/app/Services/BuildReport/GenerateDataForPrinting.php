<?php

declare(strict_types=1);

namespace App\Services\BuildReport;

/**
 * Class GenerateDataForPrinting
 *
 * This class is responsible for formatting data for printing in a report.
 */
class GenerateDataForPrinting
{
     /**
     * Formats the provided data for printing in a report.
     *
     * @param array $resultNameRacer An array containing results with racer names.
     * @param array $differenceTimeArray An array containing calculated time differences.
     * @return array Formatted data for printing in the report.
     */
    public function formingDataForPrinting(array $resultNameRacer, array $differenceTimeArray): array
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