<?php

declare(strict_types=1);

namespace Tests\Feature;

use Database\Seeders\TestReportSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(TestReportSeeder::class);
    }

    public function testShowStatisticsPage(): void
    {
        $response = $this->get(route('report.statistics'));

        $response->assertStatus(200)
            ->assertViewIs('report.statistics')
            ->assertSeeText(
                [
                    'Common statistic',
                    'Lewis Hamilton',
                    'Esteban Ocon',
                    'Daniel Ricciardo',
                    'Kevin Magnussen'
                ]
            );
    }

    public function testShowDriversNameList(): void
    {
        $response = $this->get(route('report.drivers'));

        $response->assertStatus(200)
            ->assertViewIs('report.drivers')
            ->assertSeeText(
                [
                    'List of drivers',
                    'Lewis Hamilton',
                    'Esteban Ocon',
                    'Daniel Ricciardo',
                    'Kevin Magnussen'
                ]
            );
    }

    /**
     * @dataProvider driverInfoProvider
     */
    public function testShowDriverInfoPage(string $driverId, string $driverName): void
    {
        $response = $this->get(route('report.driver_info', ['driver_id' => $driverId]));

        $response->assertStatus(200)
            ->assertViewIs('report.driver_info')
            ->assertSee('Driver Info')
            ->assertSee($driverName);
    }

    public static function driverInfoProvider(): array
    {
        return [
            ['LHM', 'Lewis Hamilton'],
            ['EOF', 'Esteban Ocon'],
            ['DRR', 'Daniel Ricciardo'],
            ['KMH', 'Kevin Magnussen']
        ];
    }
    

    public function testSortingByLapTimeAsc(): void
    {
        $response = $this->get(route('report.statistics', ['order' => 'asc']));

        $response->assertStatus(200)
            ->assertSeeInOrder(
                [
                    'Lewis Hamilton',
                    'Esteban Ocon',
                    'Daniel Ricciardo',
                    'Kevin Magnussen'
                ]
            );
    }

    public function testSortingByLapTimeDesc(): void
    {
        $response = $this->get(route('report.statistics', ['order' => 'desc']));

        $response->assertStatus(200)
            ->assertSeeInOrder(
                [
                    'Kevin Magnussen',
                    'Daniel Ricciardo',
                    'Esteban Ocon',
                    'Lewis Hamilton'
                ]
            );
    }

    public function testPageNotFound(): void
    {
        $response = $this->get('/nonexistent-page');

        $response->assertStatus(404);
    }
}