<?php

declare(strict_types=1);

namespace Tests\Services\BuildReport;

use App\Services\BuildReport\ProcessDataService;
use App\Services\BuildReport\ExtractDataFromFile;
use PHPUnit\Framework\TestCase;

class ProcessDataServiceTest extends TestCase
{
    public function testExtractDataStartAndEnd(): void
    {
        $extractDataFromFileMock = $this->createMock(ExtractDataFromFile::class);
        $extractDataFromFileMock->method('extractingDataFromFile')
            ->willReturn('SVF2018-05-24_12:02:58.917');

        $processDataLapService = new ProcessDataService($extractDataFromFileMock);

        $expectedResult = [
            "SVF" => "12:02:58.917"
        ];

        $result = $processDataLapService->extractDataStartAndEnd('path/to');

        $this->assertEquals($expectedResult, $result);
    }

    public function testExtractDataStartAndEndWithEmptyArg(): void
    {
        $extractDataFromFileMock = $this->createMock(ExtractDataFromFile::class);
        $extractDataFromFileMock->method('extractingDataFromFile')
            ->willReturn('');

        $processDataLapService = new ProcessDataService($extractDataFromFileMock);

        $expectedResult = ['' => ''];

        $result = $processDataLapService->extractDataStartAndEnd('path/to');

        $this->assertEquals($expectedResult, $result);
    }

    public function testExtractNameRacers(): void
    {
        $extractDataFromFileMock = $this->createMock(ExtractDataFromFile::class);
        $extractDataFromFileMock->method('extractingDataFromFile')
            ->willReturn('CSR_Carlos Sainz_RENAULT');

        $processDataRacerService = new ProcessDataService($extractDataFromFileMock);

        $expectedResult = [
            "CSR" => "Carlos Sainz_RENAULT"
        ];

        $result = $processDataRacerService->extractNameRacers("path/to");

        $this->assertEquals($expectedResult, $result);
    }

    public function testExtractNameRacersWithEmptyArg(): void
    {
        $extractDataFromFileMock = $this->createMock(ExtractDataFromFile::class);
        $extractDataFromFileMock->method('extractingDataFromFile')
            ->willReturn('');

        $processDataRacerService = new ProcessDataService($extractDataFromFileMock);

        $expectedResult = [];

        $result = $processDataRacerService->extractNameRacers("path/to");

        $this->assertEquals($expectedResult, $result);
    }
}