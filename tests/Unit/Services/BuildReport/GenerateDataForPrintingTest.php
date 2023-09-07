<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Services\BuildReport\GenerateDataForPrinting;

class GenerateDataForPrintingTest extends TestCase
{
    public function testFormingDataForPrinting()
    {
        $generator = new GenerateDataForPrinting();

        $resultNameRacer = ["BHS" => "Brendon Hartley_SCUDERIA TORO ROSSO HONDA"];
        $differenceTimeArray = ["BHS" => "01:01:13.179000"];

        $expectedData = [
            "BHS" => [
                "nameRacer" => "Brendon Hartley",
                "team" => "SCUDERIA TORO ROSSO HONDA",
                "lap_time" => "01:01:13.179000"
            ]
        ];

        $expectedResult = $generator->formingDataForPrinting($resultNameRacer, $differenceTimeArray);
        
        $this->assertEquals($expectedData, $expectedResult);
    }

    public function testFormingDataForPrintingWithEmptyInput()
    {
        $generator = new GenerateDataForPrinting();

        $resultNameRacer = [];
        $differenceTimeArray = [];

        $expectedData = [];

        $expectedResult = $generator->formingDataForPrinting($resultNameRacer, $differenceTimeArray);

        $this->assertEquals($expectedData, $expectedResult);
    }
}