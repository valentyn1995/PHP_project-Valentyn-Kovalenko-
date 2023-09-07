<?php

declare(strict_types=1);

namespace Tests\Services\BuildReport;

use App\Services\BuildReport\ProcessDataLapService;
use App\Services\BuildReport\ExtractDataFromFile;
use PHPUnit\Framework\TestCase;

class ProcessDataLapServiceTest extends TestCase
{
    public function testExtractDataStartAndEnd()
    {
        $extractDataFromFileMock = $this->createMock(ExtractDataFromFile::class);
        $extractDataFromFileMock->method('extractingDataFromFile')
            ->willReturn('SVF2018-05-24_12:02:58.917');

        $processDataLapService = new ProcessDataLapService($extractDataFromFileMock);

        $expectedResult = [
            "SVF" => "12:02:58.917"
        ];

        $result = $processDataLapService->extractDataStartAndEnd('path/to');

        $this->assertEquals($expectedResult, $result);
    }

    public function testExtractDataStartAndEndWithEmptyArg()
    {
        $extractDataFromFileMock = $this->createMock(ExtractDataFromFile::class);
        $extractDataFromFileMock->method('extractingDataFromFile')
            ->willReturn('');

        $processDataLapService = new ProcessDataLapService($extractDataFromFileMock);

        $expectedResult = ['' => ''];

        $result = $processDataLapService->extractDataStartAndEnd('path/to');

        $this->assertEquals($expectedResult, $result);
    }
}