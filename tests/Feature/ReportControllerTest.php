<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ReportControllerTest extends TestCase
{

    public function testShowStatisticsPage()
    {
        $response = $this->get(route('report.statistics'));

        $response->assertStatus(200)
            ->assertViewIs('report.statistics')
            ->assertSeeText(
                [
                    'Common statistic',
                    'Lewis Hamilton',
                    'Esteban Ocon',
                    'Sergey Sirotkin',
                    'Daniel Ricciardo',
                    'Sebastian Vettel',
                    'Valtteri Bottas',
                    'Stoffel Vandoorne',
                    'Kimi Räikkönen',
                    'Fernando Alonso',
                    'Charles Leclerc',
                    'Sergio Perez',
                    'Romain Grosjean',
                    'Pierre Gasly',
                    'Carlos Sainz',
                    'Nico Hulkenberg',
                    'Brendon Hartley',
                    'Marcus Ericsson',
                    'Lance Stroll',
                    'Kevin Magnussen'
                ]
            );
    }

    public function testShowDriversNameList()
    {
        $response = $this->get(route('report.drivers'));

        $response->assertStatus(200)
            ->assertViewIs('report.drivers')
            ->assertSeeText(
                [
                    'List of drivers',
                    'Lewis Hamilton',
                    'Esteban Ocon',
                    'Sergey Sirotkin',
                    'Daniel Ricciardo',
                    'Sebastian Vettel',
                    'Valtteri Bottas',
                    'Stoffel Vandoorne',
                    'Kimi Räikkönen',
                    'Fernando Alonso',
                    'Charles Leclerc',
                    'Sergio Perez',
                    'Romain Grosjean',
                    'Pierre Gasly',
                    'Carlos Sainz',
                    'Nico Hulkenberg',
                    'Brendon Hartley',
                    'Marcus Ericsson',
                    'Lance Stroll',
                    'Kevin Magnussen'
                ]
            );
    }

    /**
     * @dataProvider driverInfoProvider
     */
    public function testshowDriverInfoPage(string $driverId, string $driverName): void
    {
        $response = $this->get(route('report.driver_info', ['driver_id' => $driverId]));

        $response->assertStatus(200)
            ->assertViewIs('report.driver_info')
            ->assertSee('Driver Info')
            ->assertSee($driverName);
    }

    public static function driverInfoProvider()
    {
        return [
            ['LHM', 'Lewis Hamilton'],
            ['EOF', 'Esteban Ocon'],
            ['KRF', 'Kimi Räikkönen'],
            ['NHR', 'Nico Hulkenberg'],
            ['MES', 'Marcus Ericsson']
        ];
    }

    public function testSortingByLapTimeAsc()
    {
        $response = $this->get(route('report.statistics', ['order' => 'asc']));

        $response->assertStatus(200)
            ->assertSeeInOrder(
                [
                    'Lewis Hamilton',
                    'Esteban Ocon',
                    'Sergey Sirotkin',
                    'Daniel Ricciardo',
                    'Sebastian Vettel',
                    'Valtteri Bottas',
                    'Stoffel Vandoorne',
                    'Kimi Räikkönen',
                    'Fernando Alonso',
                    'Charles Leclerc',
                    'Sergio Perez',
                    'Romain Grosjean',
                    'Pierre Gasly',
                    'Carlos Sainz',
                    'Nico Hulkenberg',
                    'Brendon Hartley',
                    'Marcus Ericsson',
                    'Lance Stroll',
                    'Kevin Magnussen'
                ]
            );
    }

    public function testSortingByLapTimeDesc()
    {
        $response = $this->get(route('report.statistics', ['order' => 'desc']));

        $response->assertStatus(200)
            ->assertSeeInOrder(
                [
                    'Kevin Magnussen',
                    'Lance Stroll',
                    'Marcus Ericsson',
                    'Brendon Hartley',
                    'Nico Hulkenberg',
                    'Carlos Sainz',
                    'Pierre Gasly',
                    'Romain Grosjean',
                    'Sergio Perez',
                    'Charles Leclerc',
                    'Fernando Alonso',
                    'Kimi Räikkönen',
                    'Stoffel Vandoorne',
                    'Valtteri Bottas',
                    'Sebastian Vettel',
                    'Daniel Ricciardo',
                    'Sergey Sirotkin',
                    'Esteban Ocon',
                    'Lewis Hamilton'
                ]
            );
    }

    public function testPageNotFound()
    {
        $response = $this->get('/nonexistent-page');

        $response->assertStatus(404);
    }
}