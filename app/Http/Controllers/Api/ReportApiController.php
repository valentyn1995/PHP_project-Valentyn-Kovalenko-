<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Services\BuildReport\ReportSortingService;

class ReportApiController extends Controller
{
    public function __construct(private ReportSortingService $reportSortingService)
    {

    }
    public function getReport(Request $request)
    {
        $pathToFiles = base_path('files_for_report');
        $sortDirection = $request->input('order', 'asc');
        $sortedReportData = $this->reportSortingService->sortingForOutput($pathToFiles, $sortDirection);

        $format = $request->input('format', 'json');

        if ($format === 'json') {

            return Response::json($sortedReportData);
        } elseif ($format === 'xml') {
            $xmlFile = $this->convertToXml($sortedReportData);

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