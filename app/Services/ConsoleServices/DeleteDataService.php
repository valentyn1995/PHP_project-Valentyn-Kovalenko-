<?php

declare(strict_types=1);

namespace App\Services\ConsoleServices;

use App\Services\Repository\ReportRepository;

class DeleteDataService
{
    public function __construct(private ReportRepository $reportRepository)
    {

    }

    public function delete(): void
    {
        $this->reportRepository->deleteData();
    }
}