<?php

declare(strict_types=1);

namespace Tests\Services\BuildReport;

use App\Services\BuildReport\ExtractDataFromFile;
use App\Services\BuildReport\ProcessDataRacerService;
use PHPUnit\Framework\TestCase;

class ProcessDataRacerServiceTest extends TestCase
{
    public function testExtractNameRacers()
    {
        $extractDataFromFileMock = $this->createMock(ExtractDataFromFile::class);
        $extractDataFromFileMock->method('extractingDataFromFile')
            ->willReturn('CSR_Carlos Sainz_RENAULT');

        $processDataRacerService = new ProcessDataRacerService($extractDataFromFileMock);

        $expectedResult = [
            "CSR" => "Carlos Sainz_RENAULT"
        ];

        $result = $processDataRacerService->extractNameRacers("path/to");

        $this->assertEquals($expectedResult, $result);
    }

    public function testExtractNameRacersWithEmptyArg()
    {
        $extractDataFromFileMock = $this->createMock(ExtractDataFromFile::class);
        $extractDataFromFileMock->method('extractingDataFromFile')
            ->willReturn('');

        $processDataRacerService = new ProcessDataRacerService($extractDataFromFileMock);

        $expectedResult = [];

        $result = $processDataRacerService->extractNameRacers("path/to");

        $this->assertEquals($expectedResult, $result);
    }
}