<?php

declare(strict_types=1);

namespace App\Services\BuildReport;

/**
 * Class CalculateDifferenceTime
 *
 * This class calculates the time differences between an array of start times and an array of lap end times.
 */
class CalculateDifferenceTime
{
    /**
     * Calculates the time differences between an array of start times and an array of lap end times.
     * 
     * @param array $arrayStart array with start time
     * @param array $arrayEnd array with lap end time
     * @return array array with calculated time differences
     * @throws \InvalidArgumentException If an error occurs while parsing the time format from report files.
     */
    public function calculatingDifferenceTime(array $arrayStart, array $arrayEnd): array
    {
        $differenceTimeArray = [];

        foreach ($arrayStart as $index => $startTime) {
            if (isset($arrayEnd[$index])) {
                $endTime = $arrayEnd[$index];

                $startTimeObj = \DateTime::createFromFormat('H:i:s.u', $startTime);
                $endTimeObj = \DateTime::createFromFormat('H:i:s.u', $endTime);

                if ($startTimeObj !== false && $endTimeObj !== false) {
                    $difference = $endTimeObj->diff($startTimeObj)->format('%H:%I:%S.%F');
                    $differenceTimeArray[$index] = $difference;
                } else {
                    throw new \InvalidArgumentException('Error in parsing the format from the report files.');
                }
            }
        }

        return $differenceTimeArray;
    }
}