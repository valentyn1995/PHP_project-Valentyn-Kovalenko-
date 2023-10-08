<?php

declare(strict_types=1);

namespace App\Services\Repository;

use App\Models\Report;

class ReportRepository implements ReportRepositoryInterface
{
    public function getDataWithOrder($column, $sortDirection)
    {
        return Report::orderBy($column, $sortDirection)->get();
    }

    public function getDataWithOrderAndSelect($columnToOrder, $sortDirection, $columnsToSelect)
    {
        return Report::orderBy($columnToOrder, $sortDirection)
            ->select($columnsToSelect)
            ->get();
    }

    public function getAll()
    {
        return Report::all();
    }

    public function getWithFilters($column, $driverId)
    {
        return Report::where($column, $driverId)->first();
    }

    public function getWithFiltersAndSelect($columnDriversCode, $columnsToSelect, $driverId)
    {
        return Report::where($columnDriversCode, $driverId)
            ->select($columnsToSelect)
            ->first();
    }

    public function getWithSelect($columnDriversCode, $columnName)
    {
        return Report::select($columnDriversCode, $columnName)->get();
    }

    public function deleteData()
    {
        return Report::truncate();
    }

    public function createData($sortedReportDataWithName)
    {
        foreach ($sortedReportDataWithName as $key => $value) {
            $createdData = Report::updateOrInsert([
                'drivers_code' => $key,
                'name' => $value['nameRacer'],
                'team' => $value['team'],
                'lap_time' => $value['lap_time']
            ]);
        }
        
        return $createdData;
    }
}