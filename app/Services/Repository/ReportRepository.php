<?php

declare(strict_types=1);

namespace App\Services\Repository;

use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;

class ReportRepository implements ReportRepositoryInterface
{
    public function getDataWithOrder(string $column, string $sortDirection): Collection
    {
        return Report::orderBy($column, $sortDirection)->get();
    }

    public function getDataWithOrderAndSelect(string $columnToOrder, string $sortDirection, array $columnsToSelect): Collection
    {
        return Report::orderBy($columnToOrder, $sortDirection)
            ->select($columnsToSelect)
            ->get();
    }

    public function getAll(): Collection
    {
        return Report::all();
    }

    public function getWithFilters($column, $driverId): ?Report
    {
        return Report::where($column, $driverId)->first();
    }

    public function getWithFiltersAndSelect(string $columnDriversCode, array $columnsToSelect, string $driverId): ?Report
    {
        return Report::where($columnDriversCode, $driverId)
            ->select($columnsToSelect)
            ->first();
    }

    public function getWithSelect(string $columnDriversCode, string $columnName): Collection
    {
        return Report::select($columnDriversCode, $columnName)->get();
    }

    public function deleteData(): void
    {
        Report::truncate();
    }

    public function createData(array $sortedReportDataWithName): void
    {
        foreach ($sortedReportDataWithName as $key => $value) {
            Report::updateOrInsert([
                'drivers_code' => $key,
                'name' => $value['nameRacer'],
                'team' => $value['team'],
                'lap_time' => $value['lap_time']
            ]);
        }
    }
}