<?php

declare(strict_types=1);

namespace App\Services\Repository;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Report;

interface ReportRepositoryInterface
{
    public function getDataWithOrder(string $column, string $sortDirection): Collection;

    public function getDataWithOrderAndSelect(string $columnToOrder, string $sortDirection, array $columnsToSelect): Collection;

    public function getAll(): Collection;

    public function getWithFilters(string $column, string $driverId): ?Report;

    public function getWithFiltersAndSelect(string $columnDriversCode, array $columnsToSelect, string $driverId): ?Report;

    public function getWithSelect(string $columnDriversCode, string $columnName): Collection;

    public function deleteData(): void;

    public function createData(array $sortedReportDataWithName): void;
}