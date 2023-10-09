<?php

declare(strict_types=1);

namespace Tests\Services\BuildReport;

use App\Services\BuildReport\CalculateDifferenceTime;
use PHPUnit\Framework\TestCase;

class CalculateDifferenceTimeTest extends TestCase
{
    public function testCalculatingDifferenceTime(): void
    {
        $calculator = new CalculateDifferenceTime();

        $arrayStart = ['01:01:13.393000', '01:01:15.987000'];
        $arrayEnd = ['01:02:30.000000', '01:03:00.000000'];

        $expectedDifference = [
            0 => '00:01:16.607000',
            1 => '00:01:44.013000',
        ];

        $calculatedDifference = $calculator->calculatingDifferenceTime($arrayStart, $arrayEnd);
        $this->assertEquals($expectedDifference, $calculatedDifference);
    }

    public function testCalculatingDifferenceTimeWithInvalidTimeFormat(): void
    {
        $calculator = new CalculateDifferenceTime();

        $arrayStart = ['01:01:13.393000', 'invalid_time'];
        $arrayEnd = ['01:02:30.000000', '01:03:00.000000'];

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Error in parsing the format from the report files.');

        $calculator->calculatingDifferenceTime($arrayStart, $arrayEnd);
    }
}