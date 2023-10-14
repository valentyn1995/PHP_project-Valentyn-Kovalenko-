<?php

declare(strict_types=1);

use App\Http\ResponseFormatterApiService;
use PHPUnit\Framework\TestCase;

class ResponseFormatterApiServiceTest extends TestCase
{
    public function testJsonResponse(): void
    {
        $expectedJson = '{"LHM":{"nameRacer":"Lewis Hamilton","team":"MERCEDES","lap_time":"00:53:12.460000"}}';

        $dataForFormatting = [
            'LHM' => [
                'nameRacer' => 'Lewis Hamilton',
                'team' => 'MERCEDES',
                'lap_time' => '00:53:12.460000',
            ]
        ];

        $responseFormatter = new ResponseFormatterApiService();
        $response = $responseFormatter->format('json', $dataForFormatting);
        $result = $response->getContent();

        $this->assertSame($expectedJson, $result);
    }

    public function testXmlResponse(): void
    {
        $expectedXml = '<?xml version="1.0"?>
        <XMLreport>
        <nameRacer>Lewis Hamilton</nameRacer>
        <team>MERCEDES</team>
        <lap_time>00:53:12.460000</lap_time>
        </XMLreport>';

        $dataForFormatting = [
            'LHM' => [
                'nameRacer' => 'Lewis Hamilton',
                'team' => 'MERCEDES',
                'lap_time' => '00:53:12.460000',
            ]
        ];

        $responseFormatter = new ResponseFormatterApiService();
        $response = $responseFormatter->format('xml', $dataForFormatting);
        $result = $response->getContent();

        $this->assertXmlStringEqualsXmlString($expectedXml, $result);
    }
}