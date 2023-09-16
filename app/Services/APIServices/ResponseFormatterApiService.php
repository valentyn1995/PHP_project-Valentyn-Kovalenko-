<?php

declare(strict_types=1);

namespace App\Services\APIServices;

use Illuminate\Support\Facades\Response;

class ResponseFormatterApiService
{
    public function formatter($format, $dataForFormatting)
    {
        if ($format === 'json') {

            return Response::json($dataForFormatting);
        } elseif ($format === 'xml') {
            $xmlFile = $this->convertToXml($dataForFormatting);

            return response($xmlFile, 200)->header('Content-Type', 'application/xml');
        }
    }

    private function convertToXml(array $sortedReportData): bool|string
    {
        $xml = new \SimpleXMLElement('<XMLreport/>');
        array_walk_recursive($sortedReportData, function ($value, $key) use ($xml) {
            $xml->addChild($key, $value);
        });

        return $xml->asXML();
    }
}