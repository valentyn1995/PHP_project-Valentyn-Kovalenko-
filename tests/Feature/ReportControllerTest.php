<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReportControllerTest extends TestCase
{

    public function testShowStatisticsPage()
    {
        $response = $this->get(route('report.statistics'));

        $response->assertStatus(200)
            ->assertViewIs('report.statistics')
            ->assertSee('Common statistic');
    }

    public function testshowDriversNameList()
    {
        $response = $this->get(route('report.drivers'));

        $response->assertStatus(200)
            ->assertViewIs('report.drivers')
            ->assertSee('List of drivers');
    }

    public function testshowDriverInfoPage()
    {
        $driverId = 'BVM';
        $response = $this->get(route('report.driver_info', ['driver_id' => $driverId]));

        $response->assertStatus(200)
            ->assertViewIs('report.driver_info')
            ->assertSee('Driver Info');
    }
}