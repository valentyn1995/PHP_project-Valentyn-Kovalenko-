<?php

declare(strict_types=1);

namespace Tests\Feature;

use Database\Seeders\TestReportSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(TestReportSeeder::class);
    }

    public function testGetStatisticsApiPageJson()
    {
        $expectedJsonResponse = [
            [
                'name' => 'Lewis Hamilton',
                'team' => 'MERCEDES',
                'lap_time' => '00:53:12.460000',
            ],
            [
                'name' => 'Esteban Ocon',
                'team' => 'FORCE INDIA MERCEDES',
                'lap_time' => '00:54:13.028000',
            ],
            [
                'name' => 'Daniel Ricciardo',
                'team' => 'RED BULL RACING TAG HEUER',
                'lap_time' => '00:57:12.013000',
            ],
            [
                'name' => 'Kevin Magnussen',
                'team' => 'HAAS FERRARI',
                'lap_time' => '01:01:13.393000',
            ]
        ];

        $response = $this->get('/api/v1/report?format=json');

        $response->assertStatus(200);

        $response->assertJson($expectedJsonResponse);
    }

    public function testGetDriversApiPageJson()
    {
        $expectedJsonResponse = [
            [
                'drivers_code' => 'LHM',
                'name' => 'Lewis Hamilton'
            ],
            [
                'drivers_code' => 'EOF',
                'name' => 'Esteban Ocon',
            ],
            [
                'drivers_code' => 'DRR',
                'name' => 'Daniel Ricciardo',
            ],
            [
                'drivers_code' => 'KMH',
                'name' => 'Kevin Magnussen',
            ]
        ];

        $response = $this->get('/api/v1/report/drivers/?format=json');

        $response->assertStatus(200);

        $response->assertJson($expectedJsonResponse);
    }

    /**
     * @dataProvider driverInfoApiPageJsonProvider
     */
    public function testGetDriverInfoApiPageJson($driverID, $expectedJsonResponse)
    {
        $response = $this->get("/api/v1/report/drivers/{$driverID}?format=json");

        $response->assertStatus(200);

        $response->assertJson($expectedJsonResponse);
    }

    public static function driverInfoApiPageJsonProvider()
    {
        return [
            [
                'LHM',
                [
                    'name' => 'Lewis Hamilton',
                    'team' => 'MERCEDES',
                    'lap_time' => '00:53:12.460000'
                ]

            ],
            [
                'EOF',
                [
                    'name' => 'Esteban Ocon',
                    'team' => 'FORCE INDIA MERCEDES',
                    'lap_time' => '00:54:13.028000'
                ]
            ],
            [
                'DRR',
                [
                    'name' => 'Daniel Ricciardo',
                    'team' => 'RED BULL RACING TAG HEUER',
                    'lap_time' => '00:57:12.013000'
                ]
            ],
            [
                'KMH',
                [
                    'name' => 'Kevin Magnussen',
                    'team' => 'HAAS FERRARI',
                    'lap_time' => '01:01:13.393000'
                ]
            ]
        ];
    }

    public function testGetStatisticsApiPageXml()
    {
        $response = $this->get('/api/v1/report?format=xml');

        $response->assertStatus(200);

        $expectedXML = '<?xml version="1.0"?>
              <XMLreport>
                  <name>Lewis Hamilton</name>
                  <team>MERCEDES</team>
                  <lap_time>00:53:12.460000</lap_time>
                  <name>Esteban Ocon</name>
                  <team>FORCE INDIA MERCEDES</team>
                  <lap_time>00:54:13.028000</lap_time>
                  <name>Daniel Ricciardo</name>
                  <team>RED BULL RACING TAG HEUER</team>
                  <lap_time>00:57:12.013000</lap_time>
                  <name>Kevin Magnussen</name>
                  <team>HAAS FERRARI</team>
                  <lap_time>01:01:13.393000</lap_time>
              </XMLreport>';

        $this->assertXmlStringEqualsXmlString($expectedXML, $response->getContent());
    }

    public function testGetDriversApiPageXml()
    {
        $response = $this->get('/api/v1/report/drivers/?format=xml');

        $response->assertStatus(200);

        $expectedXML = '<?xml version="1.0"?>
              <XMLreport>
                  <drivers_code>LHM</drivers_code>
                  <name>Lewis Hamilton</name>
                  <drivers_code>EOF</drivers_code>
                  <name>Esteban Ocon</name>
                  <drivers_code>DRR</drivers_code>
                  <name>Daniel Ricciardo</name>
                  <drivers_code>KMH</drivers_code>
                  <name>Kevin Magnussen</name>
              </XMLreport>';

        $this->assertXmlStringEqualsXmlString($expectedXML, $response->getContent());
    }

    /**
     * @dataProvider driverInfoApiPageXmlProvider
     */
    public function testGetDriverInfoApiPageXml($driverID, $expectedXML)
    {
        $response = $this->get("/api/v1/report/drivers/{$driverID}/?format=xml");

        $response->assertStatus(200);


        $this->assertXmlStringEqualsXmlString($expectedXML, $response->getContent());
    }

    public static function driverInfoApiPageXmlProvider()
    {
        return [
            [
                'LHM',
                '<?xml version="1.0"?>
            <XMLreport>
                <name>Lewis Hamilton</name>
                <team>MERCEDES</team>
                <lap_time>00:53:12.460000</lap_time>
            </XMLreport>'
            ],
            [
                'EOF',
                '<?xml version="1.0"?>
            <XMLreport>
                <name>Esteban Ocon</name>
                <team>FORCE INDIA MERCEDES</team>
                <lap_time>00:54:13.028000</lap_time>
            </XMLreport>'
            ],
            [
                'DRR',
                '<?xml version="1.0"?>
            <XMLreport>
                <name>Daniel Ricciardo</name>
                <team>RED BULL RACING TAG HEUER</team>
                <lap_time>00:57:12.013000</lap_time>
            </XMLreport>'
            ],
            [
                'KMH',
                '<?xml version="1.0"?>
            <XMLreport>
                <name>Kevin Magnussen</name>
                <team>HAAS FERRARI</team>
                <lap_time>01:01:13.393000</lap_time>
            </XMLreport>'
            ]
        ];
    }
}