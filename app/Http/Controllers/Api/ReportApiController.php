<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\APIServices\ResponseFormatterApiService;
use App\Services\BuildReport\ReportSortingService;
use App\Services\BuildReport\ReportService;
use OpenAPI\Annotations as OA;
use App\Services\Repository\ReportRepository;

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
        private ReportSortingService $reportSortingService,
        private ReportService $reportService,
        private ResponseFormatterApiService $responseFormatterApiService,
        private ReportRepository $reportRepository
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
        $columnToOrder = 'lap_time';
        $columnsToSelect = ['name', 'team', 'lap_time'];

        $sortedReportData = $this->reportRepository->getDataWithOrderAndSelect($columnToOrder, $sortDirection, $columnsToSelect);

        $infoReportArray = $sortedReportData->toArray();

        $format = $request->input('format', 'json');

        return $this->responseFormatterApiService->format($format, $infoReportArray);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/report/drivers",
     *     summary="Get driver's name",
     *     tags={"Report"},
     *     @OA\Parameter(
     *         name="format",
     *         in="query",
     *         description="Response format (json or xml)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
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
        $columnDriversCode = 'drivers_code';
        $columnName = 'name';

        $sortedReportDataWithName = $this->reportRepository->getWithSelect($columnDriversCode, $columnName);

        $driverId = $request->input('driver_id');

        if ($driverId) {
            return $this->getDriverInfo($request, $driverId);
        }

        $infoReportArray = $sortedReportDataWithName->toArray();

        $format = $request->input('format', 'json');

        return $this->responseFormatterApiService->format($format, $infoReportArray);
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
        $columnDriversCode = 'drivers_code';
        $columnsToSelect = ['name', 'team', 'lap_time'];

        $driverInfo = $this->reportRepository->getWithFiltersAndSelect($columnDriversCode, $columnsToSelect, $driverId);

        $infoReportArray = $driverInfo->toArray();

        $format = $request->input('format', 'json');

        return $this->responseFormatterApiService->format($format, $infoReportArray);
    }
}