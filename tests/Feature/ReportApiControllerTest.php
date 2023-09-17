<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use PHPUnit\Framework\Assert;

class ReportApiControllerTest extends TestCase
{
    public function testGetStatisticsApiPageJson()
    {
        $expectedJsonResponse = [
            'LHM' => [
                'nameRacer' => 'Lewis Hamilton',
                'team' => 'MERCEDES',
                'lap_time' => '00:53:12.460000',
            ],
            'EOF' => [
                'nameRacer' => 'Esteban Ocon',
                'team' => 'FORCE INDIA MERCEDES',
                'lap_time' => '00:54:13.028000',
            ],
        ];

        $response = $this->get('/api/v1/report?format=json');

        $response->assertStatus(200);

        $response->assertJson($expectedJsonResponse);
    }

    public function testGetDriversApiPageJson()
    {
        $expectedJsonResponse = [
            'LHM' => [
                'nameRacer' => 'Lewis Hamilton',
                'team' => 'MERCEDES',
                'lap_time' => '00:53:12.460000',
            ],
            'EOF' => [
                'nameRacer' => 'Esteban Ocon',
                'team' => 'FORCE INDIA MERCEDES',
                'lap_time' => '00:54:13.028000',
            ],
        ];

        $response = $this->get('/api/v1/report/drivers/?format=json');

        $response->assertStatus(200);

        $response->assertJson($expectedJsonResponse);
    }

    public function testGetDriverInfoApiPageJson()
    {
        $expectedJsonResponse = [
            'nameRacer' => 'Lewis Hamilton',
            'team' => 'MERCEDES',
            'lap_time' => '00:53:12.460000',
        ];

        $driverID = 'LHM';

        $response = $this->get("/api/v1/report/drivers/{$driverID}?format=json");

        $response->assertStatus(200);

        $response->assertJson($expectedJsonResponse);
    }

    public function testGetStatisticsApiPageXml()
    {
        $response = $this->get('/api/v1/report?format=xml');

        $response->assertStatus(200);

        $expectedXML = '<?xml version="1.0"?>
        <XMLreport>
            <nameRacer>Lewis Hamilton</nameRacer>
            <team>MERCEDES</team>
            <lap_time>00:53:12.460000</lap_time>
            <nameRacer>Esteban Ocon</nameRacer>
            <team>FORCE INDIA MERCEDES</team>
            <lap_time>00:54:13.028000</lap_time>
            <nameRacer>Sergey Sirotkin</nameRacer>
            <team>WILLIAMS MERCEDES</team>
            <lap_time>00:55:12.706000</lap_time>
            <nameRacer>Daniel Ricciardo</nameRacer>
            <team>RED BULL RACING TAG HEUER</team>
            <lap_time>00:57:12.013000</lap_time>
            <nameRacer>Sebastian Vettel</nameRacer>
            <team>FERRARI</team>
            <lap_time>01:01:04.415000</lap_time>
            <nameRacer>Valtteri Bottas</nameRacer>
            <team>MERCEDES</team>
            <lap_time>01:01:12.434000</lap_time>
            <nameRacer>Stoffel Vandoorne</nameRacer>
            <team>MCLAREN RENAULT</team>
            <lap_time>01:01:12.463000</lap_time>
            <nameRacer>Kimi Räikkönen</nameRacer>
            <team>FERRARI</team>
            <lap_time>01:01:12.639000</lap_time>
            <nameRacer>Fernando Alonso</nameRacer>
            <team>MCLAREN RENAULT</team>
            <lap_time>01:01:12.657000</lap_time>
            <nameRacer>Charles Leclerc</nameRacer>
            <team>SAUBER FERRARI</team>
            <lap_time>01:01:12.829000</lap_time>
            <nameRacer>Sergio Perez</nameRacer>
            <team>FORCE INDIA MERCEDES</team>
            <lap_time>01:01:12.848000</lap_time>
            <nameRacer>Romain Grosjean</nameRacer>
            <team>HAAS FERRARI</team>
            <lap_time>01:01:12.930000</lap_time>
            <nameRacer>Pierre Gasly</nameRacer>
            <team>SCUDERIA TORO ROSSO HONDA</team>
            <lap_time>01:01:12.941000</lap_time>
            <nameRacer>Carlos Sainz</nameRacer>
            <team>RENAULT</team>
            <lap_time>01:01:12.950000</lap_time>
            <nameRacer>Nico Hulkenberg</nameRacer>
            <team>RENAULT</team>
            <lap_time>01:01:13.065000</lap_time>
            <nameRacer>Brendon Hartley</nameRacer>
            <team>SCUDERIA TORO ROSSO HONDA</team>
            <lap_time>01:01:13.179000</lap_time>
            <nameRacer>Marcus Ericsson</nameRacer>
            <team>SAUBER FERRARI</team>
            <lap_time>01:01:13.265000</lap_time>
            <nameRacer>Lance Stroll</nameRacer>
            <team>WILLIAMS MERCEDES</team>
            <lap_time>01:01:13.323000</lap_time>
            <nameRacer>Kevin Magnussen</nameRacer>
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
            <nameRacer>Lewis Hamilton</nameRacer>
            <team>MERCEDES</team>
            <lap_time>00:53:12.460000</lap_time>
            <nameRacer>Esteban Ocon</nameRacer>
            <team>FORCE INDIA MERCEDES</team>
            <lap_time>00:54:13.028000</lap_time>
            <nameRacer>Sergey Sirotkin</nameRacer>
            <team>WILLIAMS MERCEDES</team>
            <lap_time>00:55:12.706000</lap_time>
            <nameRacer>Daniel Ricciardo</nameRacer>
            <team>RED BULL RACING TAG HEUER</team>
            <lap_time>00:57:12.013000</lap_time>
            <nameRacer>Sebastian Vettel</nameRacer>
            <team>FERRARI</team>
            <lap_time>01:01:04.415000</lap_time>
            <nameRacer>Valtteri Bottas</nameRacer>
            <team>MERCEDES</team>
            <lap_time>01:01:12.434000</lap_time>
            <nameRacer>Stoffel Vandoorne</nameRacer>
            <team>MCLAREN RENAULT</team>
            <lap_time>01:01:12.463000</lap_time>
            <nameRacer>Kimi Räikkönen</nameRacer>
            <team>FERRARI</team>
            <lap_time>01:01:12.639000</lap_time>
            <nameRacer>Fernando Alonso</nameRacer>
            <team>MCLAREN RENAULT</team>
            <lap_time>01:01:12.657000</lap_time>
            <nameRacer>Charles Leclerc</nameRacer>
            <team>SAUBER FERRARI</team>
            <lap_time>01:01:12.829000</lap_time>
            <nameRacer>Sergio Perez</nameRacer>
            <team>FORCE INDIA MERCEDES</team>
            <lap_time>01:01:12.848000</lap_time>
            <nameRacer>Romain Grosjean</nameRacer>
            <team>HAAS FERRARI</team>
            <lap_time>01:01:12.930000</lap_time>
            <nameRacer>Pierre Gasly</nameRacer>
            <team>SCUDERIA TORO ROSSO HONDA</team>
            <lap_time>01:01:12.941000</lap_time>
            <nameRacer>Carlos Sainz</nameRacer>
            <team>RENAULT</team>
            <lap_time>01:01:12.950000</lap_time>
            <nameRacer>Nico Hulkenberg</nameRacer>
            <team>RENAULT</team>
            <lap_time>01:01:13.065000</lap_time>
            <nameRacer>Brendon Hartley</nameRacer>
            <team>SCUDERIA TORO ROSSO HONDA</team>
            <lap_time>01:01:13.179000</lap_time>
            <nameRacer>Marcus Ericsson</nameRacer>
            <team>SAUBER FERRARI</team>
            <lap_time>01:01:13.265000</lap_time>
            <nameRacer>Lance Stroll</nameRacer>
            <team>WILLIAMS MERCEDES</team>
            <lap_time>01:01:13.323000</lap_time>
            <nameRacer>Kevin Magnussen</nameRacer>
            <team>HAAS FERRARI</team>
            <lap_time>01:01:13.393000</lap_time>
        </XMLreport>';

        $this->assertXmlStringEqualsXmlString($expectedXML, $response->getContent());
    }

    public function testGetDriverInfoApiPageXml()
    {
        $driverID = 'LHM';
        $response = $this->get("/api/v1/report/drivers/{$driverID}/?format=xml");

        $response->assertStatus(200);

        $expectedXML = '<?xml version="1.0"?>
        <XMLreport>
            <nameRacer>Lewis Hamilton</nameRacer>
            <team>MERCEDES</team>
            <lap_time>00:53:12.460000</lap_time>
        </XMLreport>';

        $this->assertXmlStringEqualsXmlString($expectedXML, $response->getContent());
    }
}