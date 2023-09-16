<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\APIServices\ReportForApi;
use App\Services\APIServices\ResponseFormatterApiService;
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
    public function __construct(
        private ReportForApi $reportForApi,
        private ResponseFormatterApiService $responseFormatterApiService
    ) {

    }

    /**
     * @OA\Get(
     *     path="/api/v1/report",
     *     summary="Get report",
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
     *                 property="Driver's code",
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
    public function getStatistics(Request $request)
    {

        $sortDirection = $request->input('order', 'asc');
        $sortedReportData = $this->reportForApi->reportingForApi($sortDirection);

        $format = $request->input('format', 'json');

        return $this->responseFormatterApiService->formatter($format, $sortedReportData);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/report/drivers",
     *     summary="Get driver's name",
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
     *     @OA\PArameter(
     *         name="driver_id",
     *         in="query",
     *         description="Driver's code",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="Driver's code",
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
    public function getDriversName(Request $request)
    {
        $sortDirection = $request->input('order', 'asc');
        $sortedReportDataWithName = $this->reportForApi->reportingForApi($sortDirection);

        $driverId = $request->input('driver_id');

        if ($driverId) {
            return $this->getDriverInfo($request, $driverId);
        }
        $format = $request->input('format', 'json');

        return $this->responseFormatterApiService->formatter($format, $sortedReportDataWithName);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/report/drivers/{driver_id}",
     *     summary="Get driver information",
     *     tags={"Report"},
     *     @OA\Parameter(
     *         name="format",
     *         in="query",
     *         description="Response format (json or xml)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\PArameter(
     *         name="driver_id",
     *         in="query",
     *         description="Driver's code",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="nameRacer", type="string"),
     *             @OA\Property(property="team", type="string"),
     *             @OA\Property(property="lap_time", type="string")
     *         ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Request error",
     *     ),
     * )
     */
    public function getDriverInfo(Request $request, string $driverId)
    {
        $sortedReportDataAboutDriver = $this->reportForApi->reportingForApi($sortDirection = null);

        if (isset($sortedReportDataAboutDriver[$driverId])) {
            $driverInfo = $sortedReportDataAboutDriver[$driverId];

            $format = $request->input('format', 'json');

            return $this->responseFormatterApiService->formatter($format, $driverInfo);
        }
    }
}