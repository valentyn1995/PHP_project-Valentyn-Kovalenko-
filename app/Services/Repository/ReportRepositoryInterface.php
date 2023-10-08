<?php

declare(strict_types=1);

namespace App\Services\Repository;

interface ReportRepositoryInterface
{
    public function getDataWithOrder($column, $sortDirection);

    public function getDataWithOrderAndSelect($columnToOrder, $sortDirection, $columnsToSelect);

    public function getAll();

    public function getWithFilters($column, $driverId);

    public function getWithFiltersAndSelect($columnDriversCode, $columnsToSelect, $driverId);

    public function getWithSelect($columnDriversCode, $columnName);

    public function deleteData();

    public function createData($sortedReportDataWithName);
}