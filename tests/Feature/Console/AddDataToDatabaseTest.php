<?php

declare(strict_types=1);

namespace Tests\Feature\Console;

use Tests\TestCase;
use Database\Seeders\TestReportSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddDataToDatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(TestReportSeeder::class);
    }

    public function testConsoleAddCommandSuccess(): void
    {
        $this->artisan('add:data')->assertExitCode(0);
    }

    /**
     * @dataProvider consoleWritingDataToDatabaseProvider
     */
    public function testConsoleWritingDataToDatabase(array $expectedData): void
    {
        $this->artisan('add:data');
        
        $this->assertDatabaseHas('report', $expectedData);
    }

    public static function consoleWritingDataToDatabaseProvider(): array
    {
        return [
            [
                [
                    'drivers_code' => 'LHM',
                    'name' => 'Lewis Hamilton',
                    'team' => 'MERCEDES',
                    'lap_time' => '00:53:12.460000',
                ]
            ],
            [
                [
                    'drivers_code' => 'EOF',
                    'name' => 'Esteban Ocon',
                    'team' => 'FORCE INDIA MERCEDES',
                    'lap_time' => '00:54:13.028000',
                ]
            ],
            [
                [
                    'drivers_code' => 'DRR',
                    'name' => 'Daniel Ricciardo',
                    'team' => 'RED BULL RACING TAG HEUER',
                    'lap_time' => '00:57:12.013000',
                ]
            ],
            [
                [
                    'drivers_code' => 'KMH',
                    'name' => 'Kevin Magnussen',
                    'team' => 'HAAS FERRARI',
                    'lap_time' => '01:01:13.393000',
                ]
            ]
        ];
    }
}