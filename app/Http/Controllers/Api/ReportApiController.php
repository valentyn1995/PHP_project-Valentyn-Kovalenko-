<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Services\BuildReport\ReportSortingService;
use OpenAPI\Annotations as OA;

/**
 * @OA\Info(
 *     title="Report API",
 *     version="1.0",
 *     description="API for printing report"
 * )
 */
class ReportApiController extends Controller
{
    public function __construct(private ReportSortingService $reportSortingService)
    {

    }

    /**
     * @OA\Get(
     *     path="/api/v1/report",
     *     summary="get report",
     *     tags={"Report"},
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Sort order (asc or desc)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="format",
     *         in="query",
     *         description="Response format (json or xml)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="Driver code",
     *                 type="object",
     *                 @OA\Property(property="nameRacer", type="string"),
     *                 @OA\Property(property="team", type="string"),
     *                 @OA\Property(property="lap_time", type="string")
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Request error",
     *     ),
     * )
     */
    public function index(Request $request)
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