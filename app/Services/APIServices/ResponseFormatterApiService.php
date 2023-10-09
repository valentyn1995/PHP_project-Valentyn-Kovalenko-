<?php

declare(strict_types=1);

namespace App\Services\APIServices;

use Illuminate\Http\Response;

class ResponseFormatterApiService
{
    public function format(string $format, array $dataForFormatting): ?Response
    {
        if ($format === 'json') {
            $jsonData = json_encode($dataForFormatting);

            return new Response($jsonData, 200, [
                'Content-Type' => 'application/json',
            ]);
        } elseif ($format === 'xml') {
            $xmlFile = $this->convertToXml($dataForFormatting);

            return new Response($xmlFile, 200, [
                'Content-Type' => 'application/xml',
            ]);
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