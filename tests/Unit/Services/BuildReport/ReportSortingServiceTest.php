<?php

declare(strict_types=1);

namespace Tests\Services\BuildReport;

use App\Services\BuildReport\ReportSortingService;
use App\Services\BuildReport\ReportService;
use PHPUnit\Framework\TestCase;

class ReportSortingServiceTest extends TestCase
{
    /**
     * @dataProvider sortingForOutputProvider
     */
    public function testSortingForOutput(?string $sortDirection, array $expectedResult): void
    {
        $reportServiceMock = $this->createMock(ReportService::class);
        $reportServiceMock->method('buildingReport')
            ->willReturn([
                "BHS" => [
                    "nameRacer" => "Brendon Hartley",
                    "team" => "SCUDERIA TORO ROSSO HONDA",
                    "lap_time" => "01:01:13.179000"
                ],
                "EOF" => [
                    "nameRacer" => "Esteban Ocon",
                    "team" => "FORCE INDIA MERCEDES",
                    "lap_time" => "00:54:13.028000"
                ],
                "FAM" => [
                    "nameRacer" => "Fernando Alonso",
                    "team" => "MCLAREN RENAULT",
                    "lap_time" => "01:01:12.657000"
                ]
            ]);

        $reportSortingService = new ReportSortingService($reportServiceMock);

        $result = $reportSortingService->sortingForOutput("path/to", $sortDirection);

        $this->assertSame($expectedResult, $result);
    }

    public static function sortingForOutputProvider()
    {
        return [
            [
                'desc',
                [
                    "BHS" => [
                        "nameRacer" => "Brendon Hartley",
                        "team" => "SCUDERIA TORO ROSSO HONDA",
                        "lap_time" => "01:01:13.179000"
                    ],
                    "FAM" => [
                        "nameRacer" => "Fernando Alonso",
                        "team" => "MCLAREN RENAULT",
                        "lap_time" => "01:01:12.657000"
                    ],
                    "EOF" => [
                        "nameRacer" => "Esteban Ocon",
                        "team" => "FORCE INDIA MERCEDES",
                        "lap_time" => "00:54:13.028000"
                    ]
                ]
            ],
            [
                'asc' ?? null,
                [
                    "EOF" => [
                        "nameRacer" => "Esteban Ocon",
                        "team" => "FORCE INDIA MERCEDES",
                        "lap_time" => "00:54:13.028000"
                    ],
                    "FAM" => [
                        "nameRacer" => "Fernando Alonso",
                        "team" => "MCLAREN RENAULT",
                        "lap_time" => "01:01:12.657000"
                    ],
                    "BHS" => [
                        "nameRacer" => "Brendon Hartley",
                        "team" => "SCUDERIA TORO ROSSO HONDA",
                        "lap_time" => "01:01:13.179000"
                    ],
                ]
            ]
        ];
    }
}